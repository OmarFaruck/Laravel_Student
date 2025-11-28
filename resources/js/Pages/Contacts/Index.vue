<template>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/">
                <h2>Return Page</h2>
            </a>
            <h2>student</h2>
            <button class="btn btn-primary" @click="openCreate">
                Add Contact
            </button>
        </div>

        <div v-if="loading" class="text-center py-4">Loading...</div>

        <table v-else class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in student.data" :key="contact.id">
                    <td style="width: 80px">
                        <img
                            v-if="contact.image"
                            :src="imageUrl(contact.image)"
                            class="img-thumbnail"
                            style="width: 60px; height: 60px; object-fit: cover"
                        />
                        <span v-else class="badge bg-secondary">No</span>
                    </td>
                    <td>{{ contact.name }}</td>
                    <td>{{ contact.email }}</td>
                    <td>{{ contact.address }}</td>
                    <td style="width: 170px">
                        <button
                            class="btn btn-sm btn-info me-1"
                            @click="openEdit(contact)"
                        >
                            Edit
                        </button>
                        <button
                            class="btn btn-sm btn-danger"
                            @click="remove(contact)"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <nav v-if="student" aria-label="Page navigation">
            <ul class="pagination">
                <li
                    class="page-item"
                    :class="{ disabled: !student.prev_page_url }"
                >
                    <a
                        class="page-link"
                        @click.prevent="fetchPage(student.current_page - 1)"
                        >Previous</a
                    >
                </li>
                <li class="page-item disabled">
                    <span class="page-link"
                        >{{ student.current_page }} /
                        {{ student.last_page }}</span
                    >
                </li>
                <li
                    class="page-item"
                    :class="{ disabled: !student.next_page_url }"
                >
                    <a
                        class="page-link"
                        @click.prevent="fetchPage(student.current_page + 1)"
                        >Next</a
                    >
                </li>
            </ul>
        </nav>

        <!-- Create/Edit Modal -->
        <div class="modal" tabindex="-1" ref="modalEl">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="submit">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ isEdit ? "Edit Contact" : "Add Contact" }}
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                @click="closeModal"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input
                                    v-model="form.name"
                                    type="text"
                                    class="form-control"
                                />
                                <div
                                    v-if="errors.name"
                                    class="text-danger small"
                                >
                                    {{ errors.name[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input
                                    v-model="form.email"
                                    type="email"
                                    class="form-control"
                                />
                                <div
                                    v-if="errors.email"
                                    class="text-danger small"
                                >
                                    {{ errors.email[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea
                                    v-model="form.address"
                                    class="form-control"
                                    rows="2"
                                ></textarea>
                                <div
                                    v-if="errors.address"
                                    class="text-danger small"
                                >
                                    {{ errors.address[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input
                                    ref="imageInput"
                                    @change="onFileChange"
                                    type="file"
                                    accept="image/*"
                                    class="form-control"
                                />
                                <div v-if="form.preview" class="mt-2">
                                    <img
                                        :src="form.preview"
                                        style="
                                            width: 100px;
                                            height: 100px;
                                            object-fit: cover;
                                        "
                                    />
                                </div>
                                <div
                                    v-if="errors.image"
                                    class="text-danger small"
                                >
                                    {{ errors.image[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                @click="closeModal"
                            >
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ isEdit ? "Update" : "Save" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/bootstrap";

export default {
    name: "studentIndex",
    data() {
        return {
            student: null,
            loading: true,
            page: 1,
            isEdit: false,
            editingContactId: null,
            form: {
                name: "",
                email: "",
                address: "",
                image: null,
                preview: null,
            },
            errors: {},
        };
    },
    mounted() {
        this.fetch();
    },
    methods: {
        imageUrl(path) {
            return `/storage/${path}`;
        },
        async fetch(page = 1) {
            this.loading = true;
            try {
                const res = await axios.get(`/student?page=${page}`);
                this.student = res.data;
            } catch (e) {
                console.error(e);
                alert("Failed to load student");
            } finally {
                this.loading = false;
            }
        },
        fetchPage(page) {
            if (page < 1 || page > this.student.last_page) return;
            this.fetch(page);
        },
        openCreate() {
            this.resetForm();
            this.isEdit = false;
            this.showModal();
        },
        openEdit(contact) {
            this.resetForm();
            this.isEdit = true;
            this.editingContactId = contact.id;
            this.form.name = contact.name;
            this.form.email = contact.email;
            this.form.address = contact.address;
            this.form.preview = contact.image
                ? this.imageUrl(contact.image)
                : null;
            this.showModal();
        },
        resetForm() {
            this.form = {
                name: "",
                email: "",
                address: "",
                image: null,
                preview: null,
            };
            this.errors = {};
            this.editingContactId = null;
            if (this.$refs.imageInput) this.$refs.imageInput.value = "";
        },
        showModal() {
            const el = this.$refs.modalEl;
            if (!el) return;
            el.style.display = "block";
            el.classList.add("show");
            document.body.classList.add("modal-open");
        },
        closeModal() {
            const el = this.$refs.modalEl;
            if (!el) return;
            el.style.display = "none";
            el.classList.remove("show");
            document.body.classList.remove("modal-open");
        },
        onFileChange(e) {
            const file = e.target.files[0];
            if (!file) return;
            this.form.image = file;
            const reader = new FileReader();
            reader.onload = (ev) => {
                this.form.preview = ev.target.result;
            };
            reader.readAsDataURL(file);
        },
        async submit() {
            this.errors = {};
            const formData = new FormData();
            formData.append("name", this.form.name);
            formData.append("email", this.form.email);
            formData.append("address", this.form.address || "");
            if (this.form.image) formData.append("image", this.form.image);

            try {
                if (this.isEdit) {
                    const res = await axios.post(
                        `/student/${this.editingContactId}?_method=PUT`,
                        formData,
                        {
                            headers: { "Content-Type": "multipart/form-data" },
                        }
                    );
                } else {
                    const res = await axios.post("/student", formData, {
                        headers: { "Content-Type": "multipart/form-data" },
                    });
                }
                this.closeModal();
                this.fetch(this.student.current_page || 1);
            } catch (err) {
                if (err.response && err.response.status === 422) {
                    this.errors = err.response.data.errors || {};
                } else {
                    console.error(err);
                    alert("An error occurred");
                }
            }
        },
        async remove(student) {
            if (!confirm("Delete this contact?")) return;
            try {
                await axios.delete(`/student/${student.id}`);
                this.fetch(this.student.current_page || 1);
            } catch (e) {
                console.error(e);
                alert("Delete failed");
            }
        },
    },
};
</script>

<style scoped>
.modal {
    display: none;
    background: rgba(0, 0, 0, 0.5);
    position: fixed;
    inset: 0;
    z-index: 1050;
    overflow: auto;
}
.modal.show {
    display: block;
}
.modal-dialog {
    margin: 6rem auto;
}
</style>
