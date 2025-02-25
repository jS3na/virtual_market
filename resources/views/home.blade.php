<x-main_layout pageTitle="Home">
    Home

    @can('has_permissions', 'users.create')
    <p>test gate permissions (users.create)</p>
    @endcan

    @can('has_permissions', 'products.create')
    <p>test gate permissions (products.create)</p>
    @endcan
</x-main_layout>