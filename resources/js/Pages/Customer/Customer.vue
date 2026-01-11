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
                            style="object-fit: cover; border-radius: 10px"
                        />
                    </td>
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.address }}</td>
                    <td>
                        <button class="btn btn-outline-success me-2"><SquarePen /> Edit</button>
                        <!-- <button class="btn btn-outline-danger"><Trash2 /> Delete</button> -->
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit.prevent="submit">
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
</template>

<script setup>
import { useForm,router  } from "@inertiajs/vue3";
import { Trash2,SquarePen } from 'lucide-vue-next';
// Receive customers from Laravel
defineProps({
    customers: Array,
});

// Inertia form
const form = useForm({
    name: "",
    email: "",
    address: "",
    image: null,
});

function uploadImage(e) {
    form.image = e.target.files[0];
}

function submit() {
    form.post("/customers", {
        onSuccess: () => {

            form.reset();

            // close model
            const modalEl= document.getElementById('exampleModel');
            const model= bootstrap.Modal.getInstance(modalEl);
            model.hide();

        }
    });
}

function imgUrl(image) {
    return `/storage/${image}`;
}

// delete function
function remove(customer) {
    if (confirm("Are you sure want to delete?")) {
        router.delete(`/customers/${customer.id}`, {
            onSuccess: () => {
                console.log("Deleted Successfully");
            }
        });
    }
}
</script>
