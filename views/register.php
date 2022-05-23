<h1>CREATE NEW USER</h1>
<form method="post" action="">

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?=$model->firstName ?? ''?>">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" name="lastName" class="form-control" id="lastName" value="<?=$model->lastName ?? ''?>">
        </div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

