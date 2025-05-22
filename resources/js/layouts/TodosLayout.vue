<template>
    <div class="min-h-screen bg-white text-gray-900">
        <nav class="bg-neutral-200 shadow p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-semibold">Todo App</h1>
                <ul class="flex space-x-4">
                    <li><Link :href="route('home')" class="hover:text-blue-600">Home</Link></li>
                    <li><Link :href="route('todo.create')" class="hover:text-blue-600">Create New</Link></li>
                </ul>
            </div>
        </nav>
        <main class="container mx-auto p-4">
            <slot />
        </main>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
