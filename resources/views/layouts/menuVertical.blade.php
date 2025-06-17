 <nav class="w-64  bg-white shadow-lg border-r border-gray-200 min-h-screen">
     <div style="z-index: 10" class="fixed">
         <!-- Logo/Header -->
         <div class="p-6  border-b border-gray-100">
             <div class="flex items-center space-x-3">
                 <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                     <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M13 10V3L4 14h7v7l9-11h-7z" />
                     </svg>
                 </div>
                 <h1 class="text-xl font-semibold text-gray-800">{{ config('app.name', 'Laravel') }}</h1>
             </div>
         </div>
         <style>
             .sinsub {
                 text-decoration: none;
             }
         </style>
         <!-- Menú principal -->
         <div class="px-4 py-6 ">
             <div class="space-y-2">
                 <!-- Dashboard -->
                 <a href="{{ route('dashboard') }}"
                     class=" sinsub flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-colors duration-200">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M12.6139 1.21065C12.2528 0.929784 11.7472 0.929784 11.3861 1.21065L2.38606 8.21065C2.14247 8.4001 2 8.69141 2 9V20C2 21.1046 2.89543 22 4 22H20C21.1046 22 22 21.1046 22 20V9C22 8.69141 21.8575 8.4001 21.6139 8.21065L12.6139 1.21065ZM16 20H20V9.48908L12 3.26686L4 9.48908V20H8V12C8 11.4477 8.44772 11 9 11H15C15.5523 11 16 11.4477 16 12V20ZM10 20V13H14V20H10Z"
                             fill="black" />
                     </svg>
                     <span class="font-medium">Dashboard</span>
                 </a>
                 <a href="{{ route('productos.index') }}"
                     class=" sinsub flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('productos.*') ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-colors duration-200">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M10.5431 1.66549C11.4491 1.16212 12.5509 1.16212 13.4569 1.66549L21.4856 6.12589C21.8031 6.30225 22 6.63685 22 7C22 7.00002 22 6.99998 22 7V16.4116C22 17.1379 21.6062 17.8072 20.9713 18.1599L12.5015 22.8653C12.2067 23.0366 11.7933 23.0366 11.4985 22.8653L3.02871 18.1599C2.39378 17.8072 2 17.1379 2 16.4116V7.00005C2.00002 6.6369 2.19691 6.30225 2.51436 6.12589L10.5431 1.66549ZM12.4856 3.41381C12.1836 3.24602 11.8164 3.24602 11.5144 3.41381L9.55918 4.50002L16.5001 8.35606L18.9409 7.00005L12.4856 3.41381ZM5.05913 7.00005L7.50005 5.64397L14.4409 9.50002L12 10.8561L5.05913 7.00005ZM13 20.3005L20 16.4116V8.69956L13 12.5884V20.3005ZM4 8.69956L11 12.5884V20.3005L4 16.4116V8.69956Z"
                             fill="black" />
                     </svg>
                     <span class="font-medium">Productos</span>
                 </a>
                 <a href="{{ route('entradas.index') }}"
                     class=" sinsub flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('entradas.*') ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-colors duration-200">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <path
                             d="M17 20C16.4477 20 16 20.4477 16 21C16 21.5523 16.4477 22 17 22H20C21.1046 22 22 21.1046 22 20V4C22 2.89543 21.1046 2 20 2H17C16.4477 2 16 2.44772 16 3C16 3.55228 16.4477 4 17 4H20V20H17Z"
                             fill="black" />
                         <path
                             d="M16.7071 12.7071C16.8034 12.6108 16.876 12.4997 16.9248 12.3811C16.9729 12.2645 16.9996 12.1369 17 12.003L17 12L17 11.997C16.9992 11.7289 16.8929 11.4855 16.7204 11.3064L16.7055 11.2913L11.7071 6.29289C11.3166 5.90237 10.6834 5.90237 10.2929 6.29289C9.90237 6.68342 9.90237 7.31658 10.2929 7.70711L13.5858 11L3 11C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13L13.5858 13L10.2929 16.2929C9.90237 16.6834 9.90237 17.3166 10.2929 17.7071C10.6834 18.0976 11.3166 18.0976 11.7071 17.7071L16.7071 12.7071Z"
                             fill="black" />
                     </svg>
                     <span class="font-medium">Entradas</span>
                 </a>

                 <!-- Usuarios -->
                 <a href="{{ route('ventas.index') }}"
                     class=" sinsub flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('ventas.*') ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-colors duration-200">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <path
                             d="M7 4C7.55228 4 8 3.55228 8 3C8 2.44772 7.55228 2 7 2H4C2.89543 2 2 2.89543 2 4V20C2 21.1046 2.89543 22 4 22H7C7.55228 22 8 21.5523 8 21C8 20.4477 7.55228 20 7 20H4V4H7Z"
                             fill="black" />
                         <path
                             d="M21.7071 12.7071L16.7071 17.7071C16.3166 18.0976 15.6834 18.0976 15.2929 17.7071C14.9024 17.3166 14.9024 16.6834 15.2929 16.2929L18.5858 13H8C7.44771 13 7 12.5523 7 12C7 11.4477 7.44771 11 8 11H18.5858L15.2929 7.70711C14.9024 7.31658 14.9024 6.68342 15.2929 6.29289C15.6834 5.90237 16.3166 5.90237 16.7071 6.29289L21.7071 11.2929C22.0976 11.6834 22.0976 12.3166 21.7071 12.7071Z"
                             fill="black" />
                     </svg>
                     <span class="font-medium">Ventas</span>
                 </a>
         


                 <!-- Reportes -->
                
             </div>
             <div class="border-t border-gray-100 my-6"></div>
             <a href="{{ route('logs') }}"
                 class=" sinsub flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('logs') ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-colors duration-200">
                 <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                     <defs>

                         <style>
                             .cls-1 {
                                 fill: #4285f4;
                             }

                             .cls-2 {
                                 fill: #669df6;
                             }

                             .cls-3 {
                                 fill: #aecbfa;
                             }

                             .cls-4 {
                                 fill: none;
                             }
                         </style>

                     </defs>

                     <title>Icon_24px_CloudAuditLogs_Color</title>

                     <g data-name="Product Icons">

                         <g data-name="colored-32/cloud-audit-logs">

                             <g>

                                 <path id="Fill-3" class="cls-1"
                                     d="M12.77,12.72a1.07,1.07,0,0,1-1.52,0L9.76,11.23l.76-.76L12,11.93l4.2-4.2.81.79Z" />

                                 <path id="Fill-10" class="cls-2"
                                     d="M16,11.59a.91.91,0,0,0-.81.81,3.21,3.21,0,0,1-2.86,2.76,3.25,3.25,0,0,1-1.84-.36,3.19,3.19,0,0,1,1.2-6,3.07,3.07,0,0,1,1.21.13.9.9,0,0,0,1-.28h0a.91.91,0,0,0-.4-1.45A5,5,0,0,0,7,12.49,5,5,0,0,0,12.48,17,5,5,0,0,0,17,12.63a.91.91,0,0,0-1-1Z" />

                                 <path id="Fill-16" class="cls-3" d="M12,18a2,2,0,1,1-2,2,2,2,0,0,1,2-2" />

                                 <path id="Fill-16-2" data-name="Fill-16" class="cls-3"
                                     d="M12,2a2,2,0,1,1-2,2,2,2,0,0,1,2-2" />

                                 <rect id="Rectangle" class="cls-4" width="24" height="24" />

                             </g>

                         </g>

                         <path class="cls-1"
                             d="M18,20a1,1,0,0,1-.71-1.7L20,15.59V8.41L17.31,5.7a1,1,0,0,1,0-1.41,1,1,0,0,1,1.42,0l3,3A1,1,0,0,1,22,8v8a1,1,0,0,1-.29.7l-3,3A1,1,0,0,1,18,20Z" />

                         <path class="cls-2"
                             d="M6,20a1,1,0,0,1-.71-.3l-3-3A1,1,0,0,1,2,16V8a1,1,0,0,1,.29-.71l3-3a1,1,0,0,1,1.42,0,1,1,0,0,1,0,1.41L4,8.41v7.18L6.69,18.3a1,1,0,0,1,0,1.42A1,1,0,0,1,6,20Z" />

                     </g>

                 </svg>
                 <span class="font-medium">Logs</span>
             </a>
             <!-- Separador -->
             <div class="border-t border-gray-100 my-6"></div>

             <!-- Sección de configuración -->
             <div class="space-y-2">
                 <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3">Configuración</p>

                 <a href="{{ route('profile.edit') }}"
                     class=" sinsub flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-colors duration-200">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8ZM10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12Z"
                             fill="black" />
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M11.2865 0.5C9.88559 0.5 8.64585 1.46745 8.37147 2.85605L8.2924 3.25622C8.10465 4.20638 7.0617 4.83059 6.04486 4.48813L5.648 4.35447C4.32221 3.90796 2.83848 4.42968 2.11812 5.63933L1.40468 6.83735C0.677486 8.05846 0.954105 9.60487 2.03902 10.5142L2.35689 10.7806C3.12914 11.4279 3.12914 12.5721 2.35689 13.2194L2.03902 13.4858C0.954105 14.3951 0.677485 15.9415 1.40468 17.1626L2.11809 18.3606C2.83847 19.5703 4.32225 20.092 5.64806 19.6455L6.04481 19.5118C7.06167 19.1693 8.10465 19.7935 8.2924 20.7437L8.37148 21.1439C8.64585 22.5325 9.88559 23.5 11.2865 23.5H12.7134C14.1143 23.5 15.3541 22.5325 15.6284 21.1438L15.7074 20.7438C15.8952 19.7936 16.9381 19.1693 17.955 19.5118L18.3519 19.6455C19.6777 20.092 21.1615 19.5703 21.8818 18.3606L22.5952 17.1627C23.3224 15.9416 23.0458 14.3951 21.9608 13.4858L21.643 13.2194C20.8707 12.5722 20.8707 11.4278 21.643 10.7806L21.9608 10.5142C23.0458 9.60489 23.3224 8.05845 22.5952 6.83732L21.8818 5.63932C21.1614 4.42968 19.6777 3.90795 18.352 4.35444L17.955 4.48814C16.9381 4.83059 15.8952 4.20634 15.7074 3.25617L15.6284 2.85616C15.3541 1.46751 14.1143 0.5 12.7134 0.5H11.2865ZM10.3335 3.24375C10.4146 2.83334 10.798 2.5 11.2865 2.5H12.7134C13.2018 2.5 13.5853 2.83336 13.6663 3.24378L13.7454 3.64379C14.1789 5.83811 16.4906 7.09167 18.5933 6.38353L18.9903 6.24984C19.4493 6.09527 19.9391 6.28595 20.1634 6.66264L20.8769 7.86064C21.0944 8.22587 21.0206 8.69271 20.6762 8.98135L20.3583 9.24773C18.6323 10.6943 18.6323 13.3057 20.3583 14.7523L20.6762 15.0186C21.0206 15.3073 21.0944 15.7741 20.8769 16.1394L20.1635 17.3373C19.9391 17.714 19.4493 17.9047 18.9903 17.7501L18.5934 17.6164C16.4907 16.9082 14.1789 18.1618 13.7454 20.3562L13.6663 20.7562C13.5853 21.1666 13.2018 21.5 12.7134 21.5H11.2865C10.7981 21.5 10.4146 21.1667 10.3335 20.7562L10.2545 20.356C9.82089 18.1617 7.50906 16.9082 5.40641 17.6165L5.00966 17.7501C4.55068 17.9047 4.0608 17.714 3.83647 17.3373L3.12305 16.1393C2.90555 15.7741 2.97935 15.3073 3.32373 15.0186L3.6416 14.7522C5.36757 13.3056 5.36757 10.6944 3.6416 9.24779L3.32373 8.98137C2.97935 8.69273 2.90555 8.2259 3.12305 7.86067L3.83649 6.66266C4.06082 6.28596 4.55068 6.09528 5.00965 6.24986L5.40651 6.38352C7.50914 7.09166 9.82088 5.83819 10.2545 3.64392L10.3335 3.24375Z"
                             fill="black" />
                     </svg>
                     <span class="font-medium">Perfil</span>
                 </a>
             </div>
         </div>

         <!-- Usuario -->
         <div style="background-color: #f8f0ff" class="fixed  bottom-0 left-0 right-0 p-4 border-t border-gray-100 ">
             <div class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200">
                 <div
                     class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                     <span class="text-white text-sm font-medium">
                         {{ substr(Auth::user()->name, 0, 2) }}
                     </span>
                 </div>
                 <div class="flex-1">
                     <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                     <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                 </div>
                 <!-- Dropdown para logout -->
                 <form method="POST" action="{{ route('logout') }}">
                     @csrf
                     <button style="border-radius: 50%" type="submit"
                         class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                         <svg class="p-1 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                         </svg>
                     </button>
                 </form>
             </div>
         </div>
     </div>
 </nav>
