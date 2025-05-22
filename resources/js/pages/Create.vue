<template>
    <Head title="Create Todo" />
    <TodosLayout>
        <main class="flex min-h-screen items-center justify-center p-4">
            <TodoForm />
        </main>
    </TodosLayout>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import TodosLayout from '@/layouts/TodosLayout.vue';
import TodoForm from '@/components/TodoForm.vue';
</script>
