<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="../css/styles.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

  <link rel="shortcut icon" href="../images/blob.png" type="image/x-icon" />

  <script src="https://cdn.tiny.cloud/1/3iik4gctq1mgfjgkwf142nxi3qnwfk3k1bt5sdlxvy40yts6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
    tinymce.init({
      selector: 'textarea#editor',
      plugins: "lists, link, image, media, code",
      toolbar: "undo redo | fontselect | h1 h2 h3 | bold italic underline backcolor strikethrough blockquote| alignleft aligncenter alignright alignjustify |  bullist numlist  | link image media | removeformat code",
      menubar: false,
      skin: "bootstrap",
      image_title: true,
      /* enable automatic uploads of images represented by blob or data URIs*/
      automatic_uploads: true,
      /*
        URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        here we add custom filepicker only to Image dialog
      */
      file_picker_types: 'image',
      /* and here's our custom image picker*/
      file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */

        input.onchange = function() {
          var file = this.files[0];

          var reader = new FileReader();
          reader.onload = function() {
            /*
              Note: Now we need to register the blob in TinyMCEs image blob
              registry. In the next release this part hopefully won't be
              necessary, as we are looking to handle it internally.
            */
            var id = 'blobid' + (new Date()).getTime();
            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), {
              title: file.name
            });
          };
          reader.readAsDataURL(file);
        };

        input.click();
      }


    });
  </script>

  <title>Etec Study - Admin</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark navedit fixed-top" style="background-color: #0103ab !important; color: red !important">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="../images/logo.png" alt="" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Área do calouro</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Cursos
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Disciplinas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Professores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Vestibulares</a>
          </li>
        </ul>
        <div class="d-flex">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="../login.php" class="nav-link" style="color: white">Login</a>
            </li>
            <li class="nav-item">
              <a href="./" class="nav-link" style="color: white">Admin</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="col-md-12">&nbsp;</div>
  <div class="col-md-12">&nbsp;</div>
  <div class="col-md-12">&nbsp;</div>
  <div class="col-md-12">&nbsp;</div>
  <div class="col-md-12">&nbsp;</div>

  <div class="container">
    <div class="row" style="margin-top: 10px;">
      <div class="col-md-2">&nbsp;</div>
      <div class="col-md-12">
        <?php
        $pagina = filter_input(INPUT_GET, 'p');

        if (
          $pagina == '' || empty($pagina) || $pagina == 'index' ||
          $pagina == 'index.php'
        ) {
          include_once './painel.php';
        } else {
          if (file_exists($pagina . '.php')) {
            include_once $pagina . '.php';
          } else {
            echo '<div class="col-12">&nbsp;</div>'
              . '<div class="alert alert-danger" role="alert">'
              . '<h3>Erro 404</h3>'
              . '<p>Página não encontrada!</p>'
              . '</div>';
          }
        }
        ?>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>