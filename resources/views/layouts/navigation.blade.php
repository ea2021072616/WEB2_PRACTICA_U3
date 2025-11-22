<nav x-data="{ open: false }" class="bg-white border-b shadow-sm" style="border-color: #800000;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-bold text-xl" style="color: #800000;">
                        Sistema Consejería UPT
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" style="color: #333333;">
                        Dashboard
                    </x-nav-link>
                    
                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="route('atenciones.index')" :active="request()->routeIs('atenciones.*')" style="color: #333333;">
                            Atenciones
                        </x-nav-link>
                        <x-nav-link :href="route('estudiantes.index')" :active="request()->routeIs('estudiantes.*')" style="color: #333333;">
                            Estudiantes
                        </x-nav-link>
                        <x-nav-link :href="route('docentes.index')" :active="request()->routeIs('docentes.*')" style="color: #333333;">
                            Docentes
                        </x-nav-link>
                        <x-nav-link :href="route('temas.index')" :active="request()->routeIs('temas.*')" style="color: #333333;">
                            Temas
                        </x-nav-link>
                        <x-nav-link :href="route('admin.reportes')" :active="request()->routeIs('admin.reportes')" style="color: #333333;">
                            Reportes
                        </x-nav-link>
                    @elseif(Auth::user()->isDocente())
                        <x-nav-link :href="route('atenciones.index')" :active="request()->routeIs('atenciones.*')" style="color: #333333;">
                            Mis Atenciones
                        </x-nav-link>
                    @elseif(Auth::user()->isEstudiante())
                        <x-nav-link :href="route('estudiante.atenciones')" :active="request()->routeIs('estudiante.atenciones')" style="color: #333333;">
                            Mis Asesorías
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md hover:text-gray-700 focus:outline-none transition ease-in-out duration-150" style="color: #333333;">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Cerrar Sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            
            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('atenciones.index')" :active="request()->routeIs('atenciones.*')">
                    Atenciones
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('estudiantes.index')" :active="request()->routeIs('estudiantes.*')">
                    Estudiantes
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('docentes.index')" :active="request()->routeIs('docentes.*')">
                    Docentes
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('temas.index')" :active="request()->routeIs('temas.*')">
                    Temas
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reportes')" :active="request()->routeIs('admin.reportes')">
                    Reportes
                </x-responsive-nav-link>
            @elseif(Auth::user()->isDocente())
                <x-responsive-nav-link :href="route('atenciones.index')" :active="request()->routeIs('atenciones.*')">
                    Mis Atenciones
                </x-responsive-nav-link>
            @elseif(Auth::user()->isEstudiante())
                <x-responsive-nav-link :href="route('estudiante.atenciones')" :active="request()->routeIs('estudiante.atenciones')">
                    Mis Asesorías
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Perfil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Cerrar Sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
