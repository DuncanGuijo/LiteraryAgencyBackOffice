<template>
  <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
    
    <div class="hidden lg:flex flex-col justify-center bg-slate-900 px-16">
      <h1 class="text-3xl font-semibold text-white">
        Literary Agency
      </h1>
      <p class="mt-4 text-slate-300 max-w-md">
        Internal platform for editorial and contractual management
      </p>
    </div>

    <div class="flex items-center justify-center px-8">
      <div class="w-full max-w-lg">
        <router-view />
      </div>
    </div>

  </div>
</template>
