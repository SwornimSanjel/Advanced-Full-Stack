<nav style="display: flex; width:100%; justify-content:space-between;">
    <a href="/">
        Student Course App
    </a>

    <div>
        @guest
            <a href="/register">Register</a>
            <a href="/login">Login</a>
        @endguest

        @auth
            <a href="/courses">Courses</a>
            <a href="/students">Students</a>

            <form method="POST" action="/logout" style="display:inline;">
                @csrf
                <button type="submit">Log Out</button>
            </form>
        @endauth
    </div>
</nav>