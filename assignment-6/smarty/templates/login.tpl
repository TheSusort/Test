<form action="index.php" method="POST" class="form-inline" role="form">
    <div class="form-group">
        <label class="sr-only" for="student_no">Student number</label>
        <input type="text" class="form-control" id="student_no" name="student_no" placeholder="Student number">
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon">@</div>
            <input class="form-control" type="email" name="email" placeholder="Email">
        </div>
    </div>
    <button type="submit" class="btn btn-default">Login</button>
    <input type="hidden" name="action" value="login" />
</form>

<a href="index.php?action=signup">Sign up if you haven't registered yet</a>
