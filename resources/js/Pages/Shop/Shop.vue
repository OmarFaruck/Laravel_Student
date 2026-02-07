<template>
  
    <div class="card mt-4 container text-center justify-content-center">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/">
                <h2>Return Page</h2>
            </a>
            <h2>Shop Pages</h2>

            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Shop Page
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

            <tbody v-if="shops && shops.length">
                <tr v-for="shop in shops" :key="shop.id">
                    <td>{{ shop.id }}</td>
                    <td>
                        <img v-if="shop.image" :src="imgUrl(shop.image)" width="50" height="50"
                            style="object-fit: cover; border-radius: 10px" />
                    </td>
                    <td>{{ shop.name }}</td>
                    <td>{{ shop.email }}</td>
                    <td>{{ shop.address }}</td>
                    <td>
                        <button @click="edit(shop)" class="btn btn-outline-success me-2">
                            <SquarePen /> Edit
                        </button>
                        <button @click="remove(shop)" class="btn btn-sm btn-danger">
                            <Trash2 /> Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- input From Page -->
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit.prevent="submitcreate">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Shops</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name:</label>
                            <input v-model="form.name" type="text" class="form-control" />
                            <div class="text-danger" v-if="form.errors.name">
                                {{ form.errors.name }}
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
                            <label>Address:</label>
                            <input v-model="form.address" type="text" class="form-control" />
                            <div class="text-danger" v-if="form.errors.address">
                                {{ form.errors.address }}
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


    <!-- input From Page -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit.prevent="submitupdate">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Shop</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name:</label>
                            <input v-model="form.name" type="text" class="form-control" />
                            <div class="text-danger" v-if="form.errors.name">
                                {{ form.errors.name }}
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
                            <label>Address:</label>
                            <input v-model="form.address" type="text" class="form-control" />
                            <div class="text-danger" v-if="form.errors.address">
                                {{ form.errors.address }}
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { SquarePen, Trash2 } from "lucide-vue-next";
import { Modal } from "bootstrap";
import DashboardLayout from '@/Layouts/DashboardLayout.vue'

defineOptions({
    layout: DashboardLayout
})
const form = useForm({
    name: "",
    email: "",
    address: "",
    image: null,
});

function uploadImage(event) {
    form.image = event.target.files[0];
}
function submitcreate() {
    form.post("/shops", {
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

/**
 * Shop Component Props Definition
 * 
 * Defines the properties accepted by the Shop component.
 * This component is responsible for displaying and managing the shop interface.
 * 
 * @component
 * @example
 * // Usage in parent component
 * <Shop :prop-name="value" />
 * 
 * Props:
 * - Add specific prop documentation here based on your implementation
 */
defineProps({
    shops: Array,
});

function edit(shop) {
    form.id = shop.id;
    form.name = shop.name;
    form.email = shop.email;
    form.address = shop.address;
    form.image = null; // Reset image field
    const editModal = new Modal(document.getElementById("editModal"));
    editModal.show();

}


function remove(shop) {
    if (confirm("Are you sure you want to delete this shop?")) {
        form.delete(`/shops/${shop.id}`);
    }
}

function submitupdate() {
    const modalEl = document.getElementById("editModal")
    const modal = Modal.getInstance(modalEl)
    modal.hide()

    form.transform((data) => ({
        ...data,
        _method: "put",
    }))
        .post(`/shops/${form.id}`, {
            forceFormData: true,
            onFinish: () => {
                form.reset()
                document.body.classList.remove("modal-open")
                document.querySelectorAll(".modal-backdrop").forEach(el => el.remove())
            },
        });
}


</script>
