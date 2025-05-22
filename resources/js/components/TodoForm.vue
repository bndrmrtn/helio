<template>
    <form @submit.prevent="submit" class="w-full max-w-md rounded-lg bg-neutral-100 border border-gray-300 p-6 shadow-md">
        <h2 class="mb-6 text-center text-2xl font-semibold">{{ todo ? 'Update' : 'Create' }} Todo</h2>

        <div class="mb-4">
            <label class="mb-1 block text-gray-700">Description</label>
            <textarea
                v-model.lazy="form.description"
                placeholder="Description..."
                class="bg-white focus:ring-opacity-50 w-full rounded-md border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
            ></textarea>
            <div v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</div>
        </div>

        <div class="mb-4">
            <label class="mb-1 block text-gray-700">Due Date</label>
            <input
                v-model.lazy="form.due_date"
                type="datetime-local"
                class="bg-white focus:ring-opacity-50 w-full rounded-md border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" />
            <div v-if="form.errors.due_date" class="mt-1 text-sm text-red-600">{{ form.errors.due_date }}</div>
        </div>

        <div class="flex justify-between">
            <button
                :disabled="form.processing"
                class="rounded-md bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700 disabled:opacity-50"
            >
                {{ todo ? 'Update' : 'Create' }}
            </button>
            <Link :href="route('home')" class="rounded-md bg-gray-400 px-4 py-2 font-semibold text-white hover:bg-gray-500"> Back </Link>
        </div>
    </form>
</template>

<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    todo?: {id: number, description: string, due_date: string}
}>()

const form = useForm({
    description: props.todo?.description || '',
    due_date: props.todo?.due_date ? new Date(props.todo.due_date).toISOString().slice(0, 16) : null,
});

const submit = async () => {
    // form validation on client (also backend validation is there but just for the demonstration) without AI!
    if(form.description.length > 255) return form.errors.description = 'Too long. Maximum 255 characters allowed.'
    if(form.description.length == 0) return form.errors.description = 'Please fill this field.'
    if((new Date(form.due_date)).getTime() < (new Date()).getTime()) return form.errors.due_date = 'Please provide a future date'

    // update Todo if exits or delete
    if(props.todo) form.put(route('todo.update', props.todo.id))
    else form.post(route('todo.store'))
}
</script>
