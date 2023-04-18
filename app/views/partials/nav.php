<nav>
    <ul class="nav_list shadowed">
        <li><a href="/">Home</a></li>
        <li><a href="/lists">Your Lists</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/contact">Contact</a></li>

        <?php if (isAdmin()): ?>
            <li><a href="/users">Users</a></li>
        <?php endif; ?>

        <li id="logout"><a href="/logout">Logout</a></li>
    </ul>
</nav>