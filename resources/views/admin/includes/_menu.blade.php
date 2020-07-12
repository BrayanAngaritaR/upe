<aside id="sidebar-wrapper">
   <div class="sidebar-brand">
      <a href="index.html">Gestión Documental</a>
   </div>

   <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('/') }}">GD</a>
   </div>
   <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
         <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
               <i class="fas fa-fire"></i><span>Dashboard</span>
            </a>
      </li>

      <li class="nav-item">
         <a href="/calendars" class="nav-link">
            <i class="fas fa-calendar"></i><span>Calendario</span>
         </a>
      </li>

      <li class="nav-item">
         <a href="/news" class="nav-link">
            <i class="fas fa-file-alt"></i><span>Noticias</span>
         </a>
      </li>

      <li class="nav-item">
         <a href="{{ route('admin.files.index') }}" class="nav-link">
            <i class="fas fa-cloud"></i><span>{{ __('All files') }}</span>
         </a>
      </li>

      <li class="nav-item">
         <a href="{{ route('users.file.upload') }}" class="nav-link">
            <i class="fas fa-cloud"></i><span>Subir archivos</span>
         </a>
      </li>
   </ul>
</aside>