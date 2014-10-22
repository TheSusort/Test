<form action="index.php" method="POST" role="form" class="form-horizontal">
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{$name}">
        </div>
    </div>
    <div class="form-group">
        <label for="student_no" class="col-sm-3 control-label">Student number</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="student_no" name="student_no" placeholder="Enter student number" value="{$student_no}">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-9">
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your uis.no email" value="{$email}">
        </div>
    </div>
    <div class="form-group">
        <label for="user_unix" class="col-sm-3 control-label">Unix username</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="user_unix" name="user_unix" placeholder="Enter your ux.uis username" value="{$user_unix}">
        </div>
    </div>
    <div class="form-group">
        <label for="user_codeacademy" class="col-sm-3 control-label">Codecademy username</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="user_codecademy" name="user_codecademy" placeholder="Enter your Codecademy username" value="{$user_codecademy}">
        </div>
    </div>
    <div class="form-group">
        <label for="user_github" class="col-sm-3 control-label">Github username</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="user_github" name="user_github" placeholder="Enter your Github username" value="{$user_github}">
        </div>
    </div>
    <input type="hidden" name="action" value="signup" />
    <input type="hidden" name="step" value="1" />
    <button type="submit" class="btn btn-primary">Sign up</button>
</form>

<a href="index.php">Back to login page</a>
