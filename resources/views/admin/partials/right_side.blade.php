
@include('admin.partials.side_nav_info')

<side-nav 
    :items="{{ json_encode($menu) }}"
    :active-controller="{{ json_encode(get_current_controller()) }}">
</side-nav>
