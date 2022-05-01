<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>Document</title>
</head>
<body> 
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New url</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         
        <div class="mb-3">
            <div class="form-group">
            <input for="url" type="text" class="form-control my-3" id="url" placeholder="url..." autocomplete="off">
            </div>
            <div class="form-group">
            <input for="description" type="text " class="form-control my-3" id="description" placeholder="description..." autocomplete="off">
            </div>
            <div class="form-group">
            <input for="category" type="text" class="form-control my-3" id="category" placeholder="category..." autocomplete="off">
            </div>
        </div>
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-dark" onclick='addUrl()'>Add</button>
      </div>
    </div>
  </div>
</div>
    <!---->
    <!--UPDATE MODAL-->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update url</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         
        <div class="mb-3">
            <div class="form-group">
            <input for="updateUrl" type="text" class="form-control my-3" id="updateUrl"  autocomplete="off">
            </div>
            <div class="form-group">
            <input for="updateDescription" type="text " class="form-control my-3" id="updateDescription" autocomplete="off">
            </div>
            <div class="form-group">
            <input for="updateCategory" type="text" class="form-control my-3" id="updateCategory"autocomplete="off">
            </div>
        </div>
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-dark" onclick="updateUrl()">Update</button>
        <input type="hidden" id="id">
      </div>
    </div>
  </div>
</div>
    <div class="container my-3">
      <div style="flex-direction: column;">
        <h1 class="text-center">My url collection</h1>
        <button class="btn btn-dark my-4" type="button" data-bs-toggle="modal" data-bs-target="#Modal">Add url</button>
        <div class="input-group mb-3">
        <input type="text" class="form-control" id="browse-cat" placeholder="search category...">
        <button class="btn btn-dark" onclick='displayData()'type="button" id="search">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
        </button>
        </div>
      </div>
        <div id="display-data"></div>
</nav>
    </div>
  
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="lab7.js?v=9"></script>
  </body>
</html>