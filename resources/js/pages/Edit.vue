<template>
    <Head title="Edit Todo" />
    <TodosLayout>
        <main class="flex min-h-screen items-center justify-center p-4">
            <TodoForm :todo="todo" />
        </main>
    </TodosLayout>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import TodosLayout from '@/layouts/TodosLayout.vue';
import TodoForm from '@/components/TodoForm.vue';

interface Todo {
    id: number;
    title: string;
    completed: boolean;
    due_human: string
    completed_in: boolean
}

defineProps<{
    todo: Todo
}>()
</script>
