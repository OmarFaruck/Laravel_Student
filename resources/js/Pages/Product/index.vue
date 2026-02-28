<template>
    <div class="card mt-4 container text-center justify-content-center">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/">
                <h2>Return Page</h2>
            </a>
            <h2>Product Pages</h2>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Product
            </button>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody v-if="products && products.length">
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>
                        <img v-if="product.image" :src="imgUrl(product.image)" width="50" height="50" style="object-fit: cover;
                            border-radius: 10px" />
                    </td>
                    <td>{{ product.shop?.name }}</td>
                    <td>{{ product.email }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.price }}</td>
                    <td>
                        <button class="btn btn-outline-success me-2" @click="edit(product)">
                            <SquarePen /> Edit
                        </button>

                        <button class="btn btn-sm btn-danger" @click="remove(product)">
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
                        <h5 class="modal-title">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name:</label>
                            <select v-model="form.shop_id" class="form-control">
                                <option value="">-- Select Shop --</option>
                                <option v-for="shop in shops" :key="shop.id" :value="shop.id">
                                    {{ shop.name }}
                                </option>
                            </select>

                            <div class="text-danger" v-if="form.errors.shop_id">
                                {{ form.errors.shop_id }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Email:</label>
                            <input v-model="form.email" type="text" class="form-control" />
                            <div class="text-danger" v-if="form.errors.email">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Description:</label>
                            <input v-model="form.description" type="text" class="form-control" />
                            <div class="text-danger" v-if="form.errors.description">
                                {{ form.errors.description }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Price:</label>
                            <input v-model="form.price" type="text" class="form-control" />
                            <div class="text-danger" v-if="form.errors.price">
                                {{ form.errors.price }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Image:</label>
                            <input type="file" @change="uploadImage" class="form-control" />
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
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name:</label>
                            <select v-model="form.shop_id" class="form-control">
                                <option value="">-- Select Shop --</option>
                                <option v-for="shop in shops" :key="shop.id" :value="shop.id">
                                    {{ shop.name }}
                                </option>
                            </select>

                            <div class="text-danger" v-if="form.errors.shop_id">
                                {{ form.errors.shop_id }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Email:</label>
                            <input v-model="form.email" type="text" class="form-control" />
                            <div class="text-danger" v-if="form.errors.email">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Description:</label>
                            <input v-model="form.description" type="text" class="form-control" value=""/>
                            <div class="text-danger" v-if="form.errors.description">
                                {{ form.errors.description }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Image:</label>
                            <input type="file" @change="uploadImage" class="form-control" />
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
import DashboardLayout from '@/Layouts/DashboardLayout.vue'


defineOptions({
    layout: DashboardLayout
})
// Receive customers from Laravel
defineProps({
    products: Array,
    shops: Array,
});

// Inertia form
const form = useForm({
    id: null,
    shop_id: "",
    email: "",
    description: "",
    price: "",
    image: null,
});


function uploadImage(e) {
    form.image = e.target.files[0];
}

// from submit function
function submitCreate() {
    //products route এ POST request
    form.post("/products", {
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
function edit(product) {
    form.id = product.id;
    form.shop_id = product.shop_id;
    form.email = product.email;
    form.description = product.description;
    form.price = product.price;
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
        .post(`/products/${form.id}`, {
            forceFormData: true,
            onFinish: () => {
                form.reset()
                document.body.classList.remove("modal-open")
                document.querySelectorAll(".modal-backdrop").forEach(el => el.remove())
            },
        })
}


// delete function
function remove(product) {
    if (confirm("Are you sure want to delete ?")) {
        router.delete(`/products/${product.id}`, {
            onSuccess: () => {
                console.log("Deleted Successfully");
            },
        });
    }
}
</script>
