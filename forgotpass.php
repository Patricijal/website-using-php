<html lang="lt">
<head>
    <meta charset="utf-8">
    <title>Slaptažodžio keitimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Slaptažodžio keitimas</h5>
                        <p>Slaptažodžio keitimo instrukcijos bus atsiųstos jūsų nurodytu el.paštu</p>
                        <form action="process.php?action=resetrequest" method="POST" class="login">
                            <div class="form-label-group">
                                <label for="inputUser">El. paštas</label>
                                <input type="email" id="inputemail" name="email" class="form-control" placeholder="El.paštas" required />
                            </div>

                    </div>
                    <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit" value="resetrequest">Siųsti</button>
                    <input type="hidden" />
                    </form>
                    <?php
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
 
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
