<script setup lang="ts">
import { Head, useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import CommitteeForm from './components/CommitteeForm.vue';

const props = defineProps<{
    committee: any;
    parents: any[];
}>();

const form = useForm({
    name: props.committee.name,
    parent_id: props.committee.parent_id ?? null,
});

defineOptions({
    layout: AdminLayout,
})
const submit = () => {
    form.put(`/admin/committees/${props.committee.id}`);
};
</script>

<template>
    <Head title="Edit Committee" />

    <div class="p-5">
        <div class="mb-5">
            <Link href="/admin/committees" class="text-blue-600 hover:underline">
                ← Back to Committees
            </Link>
            <h1 class="mt-3 text-2xl font-bold">Edit Committee</h1>
        </div>

        <div class="max-w-lg">
            <CommitteeForm :form="form" :parents="parents" :submit="submit" />
        </div>
    </div>
</template>