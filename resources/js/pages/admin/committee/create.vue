<script setup lang="ts">
import { useForm, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import CommitteeForm from './components/CommitteeForm.vue';

const props = defineProps<{ 
    parents: any[] 
}>();

// Get parent_id from URL query param
const urlParams = new URLSearchParams(window.location.search);
const parentId = urlParams.get('parent_id');

const form = useForm({
    name: '',
    parent_id: parentId ? Number(parentId) : null,
});

const submit = () => {
    form.post('/admin/committees');
};
defineOptions({
    layout:AdminLayout,
})
</script>

<template>
    <Head title="Create Committee" />

    <div class="p-5">
        <div class="mb-5">
            <Link href="/admin/committees" class="text-blue-600 hover:underline">
                ← Back to Committees
            </Link>
            <h1 class="mt-3 text-2xl font-bold">Create New Committee</h1>
        </div>

        <div class="max-w-lg">
            <CommitteeForm :form="form" :parents="parents" :submit="submit" />
        </div>
    </div>
</template>