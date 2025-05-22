<template>
    <Head title="Todos" />
    <TodosLayout>
        <main class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
            <section v-for="todo in todos.data" :key="todo.id" class="bg-neutral-100 rounded shadow border-neutral-300">
                <header class="flex items-center justify-between border-b py-2 px-4 border-b-neutral-200">
                    <p>ID: {{ todo.id }}</p>
                    <p v-if="!todo.completed">Due date: {{ todo.due_human }}</p>
                    <p v-else class="text-green-400">Completed (in {{ todo.completed_in }})</p>
                </header>
                <p class="px-4 py-3">
                    {{ todo.description }}
                </p>
                <footer class="flex items-center space-x-2 px-4 py-2 border-t border-t-neutral-200">
                    <Link :href="route('todo.destroy', todo.id)"
                          class="px-3 py-1 bg-red-400 text-white rounded hover:bg-red-500 transition cursor-pointer">
                        Delete
                    </Link>
                    <Link v-if="!todo.completed" :href="route('todo.edit', todo.id)"
                          class="px-3 py-1 bg-blue-400 text-white rounded hover:bg-blue-500 transition cursor-pointer">
                        Edit
                    </Link>
                    <Link v-if="!todo.completed && new Date(todo.due_date) > new Date()" :href="route('todo.finish', todo.id)"
                          class="px-3 py-1 bg-green-400 text-white rounded hover:bg-green-500 transition cursor-pointer">
                        Finish
                    </Link>
                </footer>
            </section>
            <section v-if="todos.data.length == 0 && todos.current_page == 1">
                <h2 class="text-xl">Nothing to do.</h2>
            </section>
        </main>

    <nav class="flex justify-center mt-6 space-x-2">
        <Link
            :disabled="!todos.prev_page_url"
            :href="todos.prev_page_url"
            class="px-3 py-1 rounded bg-gray-300 disabled:opacity-50"
        >
            Prev
        </Link>
        <span class="px-3 py-1">{{ todos.current_page }} / {{ todos.last_page }}</span>
        <Link
            :disabled="!todos.next_page_url"
            :href="todos.next_page_url"
            class="px-3 py-1 rounded bg-gray-300 disabled:opacity-50"
        >
            Next
        </Link>
    </nav>
    </TodosLayout>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import TodosLayout from '@/layouts/TodosLayout.vue';

interface Todo {
    id: number;
    title: string;
    completed: boolean;
    due_date: string
    due_human: string
    completed_in: boolean
}

interface Pagination<T> {
    data: T[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

const props = defineProps<{ todos: Pagination<Todo> }>();
const todos = props.todos;
</script>

