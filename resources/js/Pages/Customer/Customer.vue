<template>
    <div class="card mt-4 container text-center justify-content-center">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/">
                <h2>Return Page</h2>
            </a>
            <h2>Customer Pages</h2>

            <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal"
            >
                Add Customer
            </button>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody v-if="customers && customers.length">
                <tr v-for="customer in customers" :key="customer.id">
                    <td>{{ customer.id }}</td>
                    <td>
                        <img
                            v-if="customer.image"
                            :src="imgUrl(customer.image)"
                            width="50"
                            height="50"
                            style="object-fit: cover;
                            border-radius: 10px"
                            
                        />
                    </td>
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.address }}</td>
                    <td>
                        <button
                            class="btn btn-outline-success me-2" 
                            @click="edit(customer)"
                        >
                            <SquarePen /> Edit
                        </button>

                        <button
                            class="btn btn-sm btn-danger"
                            @click="remove(customer)"
                        >
                            <Trash2 /> Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!--from Show Page Modal -->
    <!-- <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleMosalLabel"
        aria-hidden="true"
    > -->
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit.prevent="submitCreate">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Customer</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name:</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="form-control"
                            />
                            <div class="text-danger" v-if="form.errors.name">
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Email:</label>
                            <input
                                v-model="form.email"
                                type="text"
                                class="form-control"
                            />
                            <div class="text-danger" v-if="form.errors.email">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Address:</label>
                            <input
                                v-model="form.address"
                                type="text"
                                class="form-control"
                            />
                            <div class="text-danger" v-if="form.errors.address">
                                {{ form.errors.address }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Image:</label>
                            <input
                                type="file"
                                @change="uploadImage"
                                class="form-control"
                            />
                            <div class="text-danger" v-if="form.errors.image">
                                {{ form.errors.image }}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Customer Page -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit.prevent="submitUpdate">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Customer</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name:</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="form-control"
                            />
                            <div class="text-danger" v-if="form.errors.name">
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Email:</label>
                            <input
                                v-model="form.email"
                                type="text"
                                class="form-control"
                            />
                            <div class="text-danger" v-if="form.errors.email">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Address:</label>
                            <input
                                v-model="form.address"
                                type="text"
                                class="form-control"
                            />
                            <div class="text-danger" v-if="form.errors.address">
                                {{ form.errors.address }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Image:</label>
                            <input
                                type="file"
                                @change="uploadImage"
                                class="form-control"
                            />
                            <div class="text-danger" v-if="form.errors.image">
                                {{ form.errors.image }}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm, router } from "@inertiajs/vue3";
import { Trash2, SquarePen } from "lucide-vue-next";
import { Modal } from "bootstrap";
// Receive customers from Laravel
defineProps({
    customers: Array,
});

// Inertia form
const form = useForm({
    id: null,
    name: "",
    email: "",
    address: "",
    image: null,
});
 

function uploadImage(e) {
    form.image = e.target.files[0];
}

// from submit function
function submitCreate() {
    //customers route এ POST request 
    form.post("/customers", {
        // insert data
        onSuccess: () => {

            // Form এর সব input ফাঁকা করে দেয়
            form.reset();
            
            //   HTML এর এই modal টা ধরছে:
            const modalEl = document.getElementById("exampleModal");
            const modal = Modal.getInstance(modalEl) || new Modal(modalEl);

            // Modal বন্ধ করা
            modal.hide();

            // 🔥 Force remove modal overlay + body lock
            document.body.classList.remove("modal-open");
            document
                .querySelectorAll(".modal-backdrop")
                .forEach((el) => el.remove());
        },
    });
}

function imgUrl(image) {
    return `/storage/${image}`;
}

// from submit function for edit
function edit(customer) {
    form.id = customer.id;
    form.name = customer.name;
    form.email = customer.email;
    form.address = customer.address; 
    const modalEl = document.getElementById("editModal");
    const modal = Modal.getOrCreateInstance(modalEl);
    modal.show();
}

// from submit function for update
function submitUpdate() {
    const modalEl = document.getElementById("editModal")
    const modal = Modal.getInstance(modalEl)
    modal.hide()

    form.transform((data) => ({
        ...data,
        _method: "put",
    }))
    .post(`/customers/${form.id}`, {
        forceFormData: true,
        onFinish: () => {
            form.reset()
            document.body.classList.remove("modal-open")
            document.querySelectorAll(".modal-backdrop").forEach(el => el.remove())
        },
    })
}


// delete function
function remove(customer) {
    if (confirm("Are you sure want to delete ?")) {
        router.delete(`/customers/${customer.id}`, {
            onSuccess: () => {
                console.log("Deleted Successfully");
            },
        });
    }
}
</script>
