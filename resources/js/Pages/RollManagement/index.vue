<template>
  <div class="container-fluid">
    <!--start page wrapper -->
    <div class="page-wrapper">
      <div class="page-content">
        <!-- start-content -->

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
          <div class="breadcrumb-title pe-3">Tables</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Roles Table</li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <!-- <a href="roles-create.html" class="btn btn-primary">Create Role</a> -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Role</button>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Role and Permissions</h6>
        <hr>

        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <table id="myTable" class="display table table-striped">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Permissions</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Super Admin</td>
                      <td>
                        <span class="badge bg-danger">user-list</span>
                        <span class="badge bg-danger">user-create</span>
                        <span class="badge bg-danger">user-edit</span>
                        <span class="badge bg-danger">user-delete</span>
                        <span class="badge bg-danger">role-list</span>
                        <span class="badge bg-danger">role-create</span>
                        <span class="badge bg-danger">role-edit</span>
                        <span class="badge bg-danger">role-delete</span>
                      </td>
                      <td class="d-flex gap-2"> 
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">edit Role</button>
                         <button type="button" class="btn btn-danger">delete Role</button> 
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Admin</td>
                      <td>
                        <span class="badge bg-danger">user-list</span>
                        <span class="badge bg-danger">user-create</span>
                        <span class="badge bg-danger">user-edit</span>
                        <span class="badge bg-danger">user-delete</span>
                      </td>
                      <td class="d-flex gap-2">
                        <a href="roles-edit.html" class="btn btn-primary btn-small">edit</a>
                        <button type="submit" class="btn btn-danger btn-small">delete</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>


        <!-- end-content -->
      </div>
    </div>
  </div>

  <!-- Start Modal -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="card">
              <div class="card-body p-4">
                <form action="" method="post">

                  <div class="form-group mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Role Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" value=""
                        placeholder="Enter Your Role Name">
                    </div>

                  </div>
                  <div class="form-group mb-3">
                    <div class="col-sm-9 form-check">
                      <label class="form-check-label">
                        <input type="checkbox" name="permission[]" value="" class="form-check-input">
                        user-list
                      </label>
                      <br />
                      <label class="form-check-label">
                        <input type="checkbox" name="permission[]" value="" class="form-check-input">
                        user-create
                      </label>
                      <br />
                      <label class="form-check-label">
                        <input type="checkbox" name="permission[]" value="" class="form-check-input">
                        user-edit
                      </label>
                      <br />
                      <label class="form-check-label">
                        <input type="checkbox" name="permission[]" value="" class="form-check-input">
                        user-delete
                      </label>
                      <br />
                    </div>

                  </div>
                  <button type="submit" class="btn btn-primary px-4">Save</button>
                </form>
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- End Modal -->


   <!-- Edit Modal Start -->
     <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="card">
              <div class="card-body p-4">
                <form action="" method="post">

                  <div class="form-group mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Role Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" value=""
                        placeholder="Enter Your Role Name">
                    </div>

                  </div>
                  <div class="form-group mb-3">
                    <div class="col-sm-9 form-check">
                      <label class="form-check-label">
                        <input type="checkbox" name="permission[]" value="" class="form-check-input">
                        user-list
                      </label>
                      <br />
                      <label class="form-check-label">
                        <input type="checkbox" name="permission[]" value="" class="form-check-input">
                        user-create
                      </label>
                      <br />
                      <label class="form-check-label">
                        <input type="checkbox" name="permission[]" value="" class="form-check-input">
                        user-edit
                      </label>
                      <br />
                      <label class="form-check-label">
                        <input type="checkbox" name="permission[]" value="" class="form-check-input">
                        user-delete
                      </label>
                      <br />
                    </div>

                  </div>
                  <button type="submit" class="btn btn-primary px-4">Save</button>
                </form>
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>
   <!-- Edit Modal end -->
</template>

<script>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

export default {
  layout: DashboardLayout,
}


</script>

<script setup>
</script>