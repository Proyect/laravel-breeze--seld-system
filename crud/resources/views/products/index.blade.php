@extends('layouts.app')
@section('content')

<div  class="contaner">
    <div class="text-rigth">
      <button type="button" class="btn btn-primary btn-outline-light fw-bold"  data-bs-toggle="modal"
        data-bs-target="#modal_data">
        <i class="bi bi-plus-circle"></i> New
      </button>
    </div>

    <h2>Registered Product</h2>
    <table id="data" class="table table-striped w-100">
      <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Status</th>
            <th>OP</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Status</th>
            <th>OP</th>
      </tr>
        </tfoot>
       <tbody>
      </tbody>
    </table>
    </div>

    <!-- Modal New and edit-->
  <div class="modal fade" id="modal_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <h2>Registration Form</h2>
          <form id="registration-form" class="form" method= "POST" action="sendData.php">
            @csrf
            <div class="row">
            <div class="col">
                <label for="name">ID:</label>
                <input type="text" id="id" name="id" class="form-control w50" required>
            </div>
            <div class="col">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" class="form-control w50" required>
            </div>
            <div class="col">
              <label for="name">Description:</label>
              <input type="text" id="description" name="lastName" class="form-control w50" required>
            </div>
            </div>
            <div class="row">
              <div class="col">
                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control" required>
              </div>
              <div class="col">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" class="form-control" required>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <label for="price">Status:</label>
                <input type="number" step="0.01" id="status" name="price" class="form-control" required>
              </div>
              <div class="col">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" class="form-control" required>
              </div>

            </div>
            <hr/>
            <div class="row">
              <div class="col text-center">
                <button  class="btn btn-primary btn-outline-light fw-bold" id="updateData" >
                <i class="bi bi-pencil-fill" title="Edit" name="edt"></i> Register
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="send_data">
                  <i class="bi bi-x-square"></i></i> Close
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


  <!-- Modal Are you Segure?-->
  <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="idAlert">Alert</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        Are you sure to delete the datas?
        </div>
        <div class="modal-footer">
          <form action="sendData.php" id="delete-form" method= "POST" action="sendData.php">
            @csrf
            <input type="hidden" name="id" id="id" value="0">
            <button type="button" class="btn btn-danger btn-outline-light" type="submit">Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           </form>
        </div>
      </div>
    </div>
  </div>

  <!--Notifications -->
    <div class="modal" id="toast" tabindex="-1" aria-labelledby="toastLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary bg-gradient text-white">
            <h5 class="modal-title" id="toastLabel">Notificaciones</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="body_toast">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-outline-light fw-bold" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  <!-- Librería jQuery requerida por los plugins de JavaScript -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


      <!-- Data Tables -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
      <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
      <script src="./media/js/products.js"></script>
      <script>


      </script>

    @endsection
