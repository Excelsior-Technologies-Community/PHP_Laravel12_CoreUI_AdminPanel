<header class="c-header c-header-light c-header-fixed d-flex justify-content-between align-items-center px-3">
   <br>
    <div>
        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
</header>
