<template>
    <div class="card mt-4 container text-center justify-content-center">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/">
                <h2>Return Page</h2>
            </a>
            <h2>Customer Pages</h2>
            <!-- <button class="btn btn-primary" @click="openCreate"> -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                Add Customer
            </button>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Image</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">address</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ------Form Modal start------- -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="recipient-name" placeholder="Input Name">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="recipient-name" placeholder="Input Email">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Address:</label>
            <textarea class="form-control" id="message-text" placeholder="Input Address"></textarea>
          </div>
              <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Image:</label>
            <input type="file" class="form-control" id="recipient-name" placeholder="Input Image">
          </div>
        </form>
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
    <!-- ------Form Modal end--------- -->
</template>

<script>

</script>
