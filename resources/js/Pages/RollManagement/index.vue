<template>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/">
                <h2>Return Page</h2>
            </a>
            <h2>RollManagement Pages</h2>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add RollManagement
            </button>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="role in roles" :key="role.id">
                    <td>{{ role.id }}</td>
                    <td>{{ role.name }}</td>

                    <!-- ✅ PERMISSION SHOW -->
                    <td>
                        <span v-for="perm in role.permissions" :key="perm.id" class="badge bg-danger me-1">
                            {{ perm.name }}
                        </span>
                    </td>

                    <td class="d-flex">
                        <button class="btn btn-danger btn-sm me-2" @click="deleteRole(role.id)">
                            Delete
                        </button>

                         <button class="btn btn-success btn-sm me-2" @click="edit(role)">
                            Edit
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- CREATE MODAL -->
        <div class="modal fade" id="exampleModal">
            <!-- insert from -->
            <div class="modal-dialog">
                <form class="modal-content" @submit.prevent="submitCreate">
                    <div class="modal-header">
                        <h5>Create Role</h5>
                    </div>

                    <div class="modal-body">
                        <!-- ROLE NAME -->
                        <input type="text" class="form-control mb-3" placeholder="Role name" v-model="form.name" />

                        <!-- ✅ PERMISSION CHECKBOX -->
                        <div v-for="permission in permissions" :key="permission.id">
                            <label>
                                <input type="checkbox" :value="permission.name" v-model="form.permissions" />
                                {{ permission.name }}
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- edit MODAL -->
        <div class="modal fade" id="editModal">
            <!-- insert from -->
            <div class="modal-dialog">
                <form class="modal-content" @submit.prevent="updateRole">
                    <div class="modal-header">
                        <h5>Update Role</h5>
                    </div>

                    <div class="modal-body">
                        <!-- ROLE NAME -->
                        <input type="text" class="form-control mb-3" placeholder="Role name" v-model="form.name" />

                        <!-- ✅ PERMISSION CHECKBOX -->
                        <div v-for="permission in permissions" :key="permission.id">
                            <label>
                                <input type="checkbox" :value="permission.name" v-model="form.permissions" />
                                {{ permission.name }}
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</template>

<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { Modal } from 'bootstrap'
import flasher from "@flasher/flasher";

defineOptions({ layout: DashboardLayout })

const props = defineProps({
    roles: Array,
    permissions: Array
})

const form = useForm({
    name: '',
    permissions: []
})

function submitCreate() {
    //customers route এ POST request
    form.post("/rollmanagement", {
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

function edit(role) {
    form.id = role.id;
    form.name = role.name;
    form.permissions = role.permissions.map(p => p.name);
   const editModal = new Modal(document.getElementById("editModal"));
    editModal.show();
}

function updateRole() {
   const modalEl = document.getElementById("editModal")
    const modal = Modal.getInstance(modalEl)
    modal.hide()

    form.transform((data) => ({
        ...data,
        _method: "put",
    }))
        .post(`/rollmanagement/${form.id}`, {
            forceFormData: true,
            onFinish: () => {
                form.reset()
                document.body.classList.remove("modal-open")
                document.querySelectorAll(".modal-backdrop").forEach(el => el.remove())
            },
        });
}

function deleteRole(id) {
    if (confirm("Are you sure you want to delete this role?")) {
        form.delete(`/rollmanagement/${id}`);
    }
}





</script>
