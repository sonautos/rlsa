<aside class="main-sidebar sidebar-light-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        {{-- <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span> --}}
        <img src="{{asset('img/rlsa.png')}}" alt="RLSA" class="brand-image elevation-3"
           style="opacity: .8; padding-left: 0px">
      <span class="brand-text font-weight-light">R.L.S.A</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- <li>
                    <select class="searchable-field form-control">

                    </select>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('vehicle_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/cars*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-car">

                            </i>
                            <p>
                                {{ trans('menu.vehicle.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('car_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.cars.index") }}" class="nav-link {{ request()->is("admin/cars") || request()->is("admin/cars/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-car">

                                        </i>
                                        <p>
                                            {{ trans('menu.car.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('contact_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/companies*") ? "menu-open" : "" }} {{ request()->is("admin/individuals*") ? "menu-open" : "" }} {{ request()->is("admin/addresses*") ? "menu-open" : "" }} {{ request()->is("admin/tag-contacts*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-user-lock">

                            </i>
                            <p>
                                {{ trans('cruds.contact.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('company_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.companies.index") }}" class="nav-link {{ request()->is("admin/companies") || request()->is("admin/companies/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.company.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('individual_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.individuals.index") }}" class="nav-link {{ request()->is("admin/individuals") || request()->is("admin/individuals/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-user-circle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.individual.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('address_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.addresses.index") }}" class="nav-link {{ request()->is("admin/addresses") || request()->is("admin/addresses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-map-pin">

                                        </i>
                                        <p>
                                            {{ trans('cruds.address.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tag_contact_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tag-contacts.index") }}" class="nav-link {{ request()->is("admin/tag-contacts") || request()->is("admin/tag-contacts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tagContact.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('order_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/orders-lists*") ? "menu-open" : "" }} {{ request()->is("admin/order-lines*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-file-signature">

                            </i>
                            <p>
                                {{ trans('menu.order.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('orders_list_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.orders-lists.index") }}" class="nav-link {{ request()->is("admin/orders-lists") || request()->is("admin/orders-lists/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-signature">

                                        </i>
                                        <p>
                                            {{ trans('menu.orders') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('order_line_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.order-lines.index") }}" class="nav-link {{ request()->is("admin/order-lines") || request()->is("admin/order-lines/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('menu.orders-details') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                {{-- @can('crm_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/*") ? "menu-open" : "" }} {{ request()->is("admin/*") ? "menu-open" : "" }} {{ request()->is("admin/*") ? "menu-open" : "" }} {{ request()->is("admin/*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('menu.crm.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('order_access')
                                <li class="nav-item has-treeview {{ request()->is("admin/orders-lists*") ? "menu-open" : "" }} {{ request()->is("admin/order-lines*") ? "menu-open" : "" }}">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <i class="fa-fw nav-icon fas fa-file-signature">

                                        </i>
                                        <p>
                                            {{ trans('menu.order.title') }}
                                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('orders_list_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.orders-lists.index") }}" class="nav-link {{ request()->is("admin/orders-lists") || request()->is("admin/orders-lists/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-file-signature">

                                                    </i>
                                                    <p>
                                                        {{ trans('menu.orders') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('order_line_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.order-lines.index") }}" class="nav-link {{ request()->is("admin/order-lines") || request()->is("admin/order-lines/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-cogs">

                                                    </i>
                                                    <p>
                                                        {{ trans('menu.orders-details') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('proforma_access')
                                <li class="nav-item has-treeview {{ request()->is("admin/proforma-lists*") ? "menu-open" : "" }} {{ request()->is("admin/proforma-lines*") ? "menu-open" : "" }}">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <i class="fa-fw nav-icon fas fa-file-contract">

                                        </i>
                                        <p>
                                            {{ trans('cruds.proforma.title') }}
                                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('proforma_list_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.proforma-lists.index") }}" class="nav-link {{ request()->is("admin/proforma-lists") || request()->is("admin/proforma-lists/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-file-contract">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.proformaList.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('proforma_line_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.proforma-lines.index") }}" class="nav-link {{ request()->is("admin/proforma-lines") || request()->is("admin/proforma-lines/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-cogs">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.proformaLine.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('invoice_access')
                                <li class="nav-item has-treeview {{ request()->is("admin/invoices-lists*") ? "menu-open" : "" }} {{ request()->is("admin/invoice-lines*") ? "menu-open" : "" }}">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <i class="fa-fw nav-icon fas fa-file-invoice-dollar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.invoice.title') }}
                                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('invoices_list_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.invoices-lists.index") }}" class="nav-link {{ request()->is("admin/invoices-lists") || request()->is("admin/invoices-lists/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-file-contract">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.invoicesList.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('invoice_line_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.invoice-lines.index") }}" class="nav-link {{ request()->is("admin/invoice-lines") || request()->is("admin/invoice-lines/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-file-invoice-dollar">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.invoiceLine.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}
                @can('shippment_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/shippmentslists*") ? "menu-open" : "" }} {{ request()->is("admin/shipp-lines*") ? "menu-open" : "" }} {{ request()->is("admin/trucks*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-truck"></i>
                            <p>
                                {{ trans('cruds.shippment.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('shippmentslist_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.shippmentslists.index") }}" class="nav-link {{ request()->is("admin/shippmentslists") || request()->is("admin/shippmentslists/*") ? "active" : "" }}">
                                        <p>{{ trans('cruds.shippmentslist.title') }}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('shipp_line_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.shipp-lines.index") }}" class="nav-link {{ request()->is("admin/shipp-lines") || request()->is("admin/shipp-lines/*") ? "active" : "" }}">
                                        <p>{{ trans('cruds.shippLine.title') }}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('truck_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.trucks.index") }}" class="nav-link {{ request()->is("admin/trucks") || request()->is("admin/trucks/*") ? "active" : "" }}">
                                        <p>{{ trans('cruds.truck.title') }}</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('task_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/tasks*") ? "menu-open" : "" }} {{ request()->is("admin/tasks-calendars*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-list">

                            </i>
                            <p>
                                {{ trans('cruds.taskManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('task_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.task.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tasks_calendar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks-calendars.index") }}" class="nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tasksCalendar.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                
                @can('general_setting_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/*") ? "menu-open" : "" }} {{ request()->is("admin/*") ? "menu-open" : "" }} {{ request()->is("admin/*") ? "menu-open" : "" }} {{ request()->is("admin/entities*") ? "menu-open" : "" }} {{ request()->is("admin/*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.generalSetting.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user_manager_access')
                                <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/teams*") ? "menu-open" : "" }}">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userManager.title') }}
                                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('permission_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-unlock-alt">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.permission.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('role_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-briefcase">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.role.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('user_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-user">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.user.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('team_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-users">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.team.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('audit_log_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-file-alt">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.auditLog.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('cars_setting_access')
                                <li class="nav-item has-treeview {{ request()->is("admin/product-categories*") ? "menu-open" : "" }} {{ request()->is("admin/product-tags*") ? "menu-open" : "" }} {{ request()->is("admin/products*") ? "menu-open" : "" }} {{ request()->is("admin/makes*") ? "menu-open" : "" }} {{ request()->is("admin/modeles*") ? "menu-open" : "" }} {{ request()->is("admin/versions*") ? "menu-open" : "" }} {{ request()->is("admin/colors*") ? "menu-open" : "" }} {{ request()->is("admin/features*") ? "menu-open" : "" }} {{ request()->is("admin/code-models*") ? "menu-open" : "" }} {{ request()->is("admin/services*") ? "menu-open" : "" }}">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <i class="fa-fw nav-icon fas fa-car">

                                        </i>
                                        <p>
                                            {{ trans('cruds.carsSetting.title') }}
                                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('product_category_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.product-categories.index") }}" class="nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-folder">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.productCategory.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('product_tag_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.product-tags.index") }}" class="nav-link {{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-folder">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.productTag.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('product_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.products.index") }}" class="nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-shopping-cart">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.product.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('make_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.makes.index") }}" class="nav-link {{ request()->is("admin/makes") || request()->is("admin/makes/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-car">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.make.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('modele_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.modeles.index") }}" class="nav-link {{ request()->is("admin/modeles") || request()->is("admin/modeles/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-car">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.modele.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('version_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.versions.index") }}" class="nav-link {{ request()->is("admin/versions") || request()->is("admin/versions/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-car">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.version.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('color_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.colors.index") }}" class="nav-link {{ request()->is("admin/colors") || request()->is("admin/colors/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-fill-drip">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.color.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('feature_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.features.index") }}" class="nav-link {{ request()->is("admin/features") || request()->is("admin/features/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-info">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.feature.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('code_model_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.code-models.index") }}" class="nav-link {{ request()->is("admin/code-models") || request()->is("admin/code-models/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-terminal">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.codeModel.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('service_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.services.index") }}" class="nav-link {{ request()->is("admin/services") || request()->is("admin/services/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-shopping-cart">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.service.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('crm_setting_access')
                                <li class="nav-item has-treeview {{ request()->is("admin/shipp-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/order-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/cond-reglements*") ? "menu-open" : "" }} {{ request()->is("admin/mode-reglements*") ? "menu-open" : "" }} {{ request()->is("admin/shipping-methods*") ? "menu-open" : "" }}">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmSetting.title') }}
                                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('shipp_status_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.shipp-statuses.index") }}" class="nav-link {{ request()->is("admin/shipp-statuses") || request()->is("admin/shipp-statuses/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-server">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.shippStatus.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('order_status_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.order-statuses.index") }}" class="nav-link {{ request()->is("admin/order-statuses") || request()->is("admin/order-statuses/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-server">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.orderStatus.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('cond_reglement_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.cond-reglements.index") }}" class="nav-link {{ request()->is("admin/cond-reglements") || request()->is("admin/cond-reglements/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-cogs">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.condReglement.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('mode_reglement_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.mode-reglements.index") }}" class="nav-link {{ request()->is("admin/mode-reglements") || request()->is("admin/mode-reglements/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-cogs">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.modeReglement.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('shipping_method_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.shipping-methods.index") }}" class="nav-link {{ request()->is("admin/shipping-methods") || request()->is("admin/shipping-methods/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-cogs">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.shippingMethod.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('entity_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.entities.index") }}" class="nav-link {{ request()->is("admin/entities") || request()->is("admin/entities/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.entity.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_setting_access')
                                <li class="nav-item has-treeview {{ request()->is("admin/task-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/task-tags*") ? "menu-open" : "" }}">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <i class="fa-fw nav-icon fas fa-tasks">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskSetting.title') }}
                                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('task_status_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.task-statuses.index") }}" class="nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-server">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.taskStatus.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('task_tag_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.task-tags.index") }}" class="nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "active" : "" }}">
                                                    <i class="fa-fw nav-icon fas fa-server">

                                                    </i>
                                                    <p>
                                                        {{ trans('cruds.taskTag.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
                    <li class="nav-item">
                        <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} nav-link" href="{{ route("admin.team-members.index") }}">
                            <i class="fa-fw fa fa-users nav-icon">
                            </i>
                            <p>
                                {{ trans("global.team-members") }}
                            </p>
                        </a>
                    </li>
                @endif
                {{-- @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
