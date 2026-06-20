<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import {route} from 'ziggy-js';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });



interface Committee {
    id: number;
    name: string;
    parent: { id: number; name: string } | null;
}

interface Program {
    id: number;
    name: string;
}

interface User {
    id: number;
    full_name: string;
    email: string;
    designation: string;
    type: string;
    member_type: string;
    is_active: boolean;
    photo_path: string;
    profile_description: string;
    fb_link: string;
    youtube_link: string;
    tiktok_link: string;
    start_date: string;
    end_date: string;
    committees: Committee[];
    programs: Program[];
}

const props = defineProps<{
    user: User;
    allCommittees: Committee[];
    allPrograms: Program[];
}>();



const availableCommittees = computed(() =>
    props.allCommittees.filter(
        (c) => !props.user.committees.some((uc) => uc.id === c.id),
    ),
);

const availablePrograms = computed(() =>
    props.allPrograms.filter(
        (p) => !props.user.programs.some((up) => up.id === p.id),
    ),
);


const committeeForm = useForm({ committee_id: '' });

function attachCommittee() {
    if (!committeeForm.committee_id) {

        return;
    }

    committeeForm.post(route('users.committees.attach', props.user.id), {
        preserveScroll: true,
        onSuccess: () => committeeForm.reset(),
    });
}

function detachCommittee(committeeId: number) {
    useForm({ committee_id: committeeId }).delete(
        route('users.committees.detach', props.user.id),
        { preserveScroll: true },
    );
}


const programForm = useForm({ program_id: '' });

function attachProgram() {
    if (!programForm.program_id) {
        return;
    }

    programForm.post(route('users.programs.attach', props.user.id), {
        preserveScroll: true,
        onSuccess: () => programForm.reset(),
    });
}

function detachProgram(programId: number) {
    useForm({ program_id: programId }).delete(
        route('users.programs.detach', props.user.id),
        { preserveScroll: true },
    );
}
</script>

<template>
    <Head :title="user.full_name" />

    <div class="flex flex-col gap-6 p-6">

        <!-- Header -->
        <div class="flex items-start justify-between">
            <div>
                <p class="mb-1 text-xs font-semibold uppercase tracking-widest text-gray-400">
                    <Link :href="route('users.index')" class="hover:text-gray-600">Users</Link>
                    <span class="mx-1">/</span>
                    {{ user.full_name }}
                </p>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    {{ user.full_name }}
                </h1>
                <p class="mt-0.5 text-sm text-gray-400">{{ user.email }}</p>
            </div>

            <div class="flex items-center gap-2">
                <span
                    class="rounded-full px-2.5 py-1 text-xs font-medium"
                    :class="user.is_active
                        ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                        : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400'"
                >
                    {{ user.is_active ? 'Active' : 'Inactive' }}
                </span>
                <Link
                    :href="route('users.edit', user.id)"
                    class=" bg-gray-900 px-3 py-1.5 text-xs font-medium text-white transition-opacity hover:opacity-80 dark:bg-white dark:text-gray-900"
                >
                    Edit
                </Link>
            </div>
        </div>

        <!-- Body -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            <!-- Left — profile -->
            <div class="flex flex-col gap-4">

                <div class="rounded-xl border border-gray-100 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-widest text-gray-400">Profile</p>
                    <div class="flex flex-col gap-2">
                        <InfoRow label="Type"        :value="user.type" />
                        <InfoRow label="Member Type" :value="user.member_type" />
                        <InfoRow label="Designation" :value="user.designation" />
                        <InfoRow label="Start Date"  :value="user.start_date" />
                        <InfoRow label="End Date"    :value="user.end_date" />
                    </div>
                    <div v-if="user.profile_description" class="mt-3 border-t pt-3 dark:border-gray-800">
                        <p class="mb-1 text-xs text-gray-400">About</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ user.profile_description }}</p>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-widest text-gray-400">Social</p>
                    <div class="flex flex-col gap-2">
                        <SocialRow label="Facebook" :href="user.fb_link" />
                        <SocialRow label="YouTube"  :href="user.youtube_link" />
                        <SocialRow label="TikTok"   :href="user.tiktok_link" />
                    </div>
                </div>

            </div>

            <!-- Right — committees + programs -->
            <div class="flex flex-col gap-6 lg:col-span-2">

                <!-- Committees -->
                <div class="rounded-xl border border-gray-100 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-widest text-gray-400">
                        Committees
                        <span class="ml-1 font-normal text-gray-300">({{ user.committees.length }})</span>
                    </p>

                    <div v-if="user.committees.length" class="flex flex-col gap-2">
                        <div
                            v-for="c in user.committees"
                            :key="c.id"
                            class="group flex items-center justify-between border border-gray-100 bg-gray-50 px-4 py-3 dark:border-gray-800 dark:bg-gray-800"
                        >
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ c.name }}</p>
                                <p v-if="c.parent" class="text-xs text-gray-400">↑ {{ c.parent.name }}</p>
                            </div>
                            <button
                                @click="detachCommittee(c.id)"
                                class="text-xs text-red-400 opacity-0 transition-opacity group-hover:opacity-100 hover:text-red-600"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                    <p v-else class="text-sm text-gray-400">No committees assigned.</p>

                    <div class="mt-3 flex gap-2 border-t pt-3 dark:border-gray-800">
                        <select v-model="committeeForm.committee_id" class="field flex-1">
                            <option value="">— Add committee —</option>
                            <option v-for="c in availableCommittees" :key="c.id" :value="c.id">
                                {{ c.name }}
                            </option>
                        </select>
                        <button
                            @click="attachCommittee"
                            :disabled="!committeeForm.committee_id || committeeForm.processing"
                            class=" bg-gray-900 px-4 py-2 text-xs font-medium text-white transition-opacity hover:opacity-80 disabled:opacity-40 dark:bg-white dark:text-gray-900"
                        >
                            Attach
                        </button>
                    </div>
                </div>

                <!-- Programs -->
                <div class="rounded-xl border border-gray-100 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-widest text-gray-400">
                        Programs
                        <span class="ml-1 font-normal text-gray-300">({{ user.programs.length }})</span>
                    </p>

                    <div v-if="user.programs.length" class="flex flex-col gap-2">
                        <div
                            v-for="p in user.programs"
                            :key="p.id"
                            class="group flex items-center justify-between  border border-gray-100 bg-gray-50 px-4 py-3 dark:border-gray-800 dark:bg-gray-800"
                        >
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ p.name }}</p>
                            <button
                                @click="detachProgram(p.id)"
                                class="text-xs text-red-400 opacity-0 transition-opacity group-hover:opacity-100 hover:text-red-600"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                    <p v-else class="text-sm text-gray-400">No programs enrolled.</p>

                    <div class="mt-3 flex gap-2 border-t pt-3 dark:border-gray-800">
                        <select v-model="programForm.program_id" class="field flex-1">
                            <option value="">— Add program —</option>
                            <option v-for="p in availablePrograms" :key="p.id" :value="p.id">
                                {{ p.name }}
                            </option>
                        </select>
                        <button
                            @click="attachProgram"
                            :disabled="!programForm.program_id || programForm.processing"
                            class=" bg-gray-900 px-4 py-2 text-xs font-medium text-white transition-opacity hover:opacity-80 disabled:opacity-40 dark:bg-white dark:text-gray-900"
                        >
                            Attach
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>


<script lang="ts">
import { defineComponent, h } from 'vue';

const InfoRow = defineComponent({
    name: 'InfoRow',
    props: {
        label: { type: String, required: true },
        value: { type: String, default: '' },
    },
    setup(props) {
        return () =>
            h('div', { class: 'flex items-center justify-between text-sm' }, [
                h('span', { class: 'text-gray-400' }, props.label),
                h('span', { class: 'font-medium capitalize text-gray-900 dark:text-white' }, props.value || '—'),
            ]);
    },
});

const SocialRow = defineComponent({
    name: 'SocialRow',
    props: {
        label: { type: String, required: true },
        href:  { type: String, default: '' },
    },
    setup(props) {
        return () => {
            const isValid = props.href && props.href !== '#';
            
            if (isValid) {
                return h('a', {
                    href: props.href,
                    target: '_blank',
                    class: 'flex items-center justify-between text-sm text-gray-500 transition-colors hover:text-gray-900 dark:text-gray-400 dark:hover:text-white',
                }, [
                    h('span', props.label),
                    h('span', { class: 'text-xs text-gray-300' }, '↗'),
                ]);
            }

            return h('div', { class: 'flex items-center justify-between text-sm' }, [
                h('span', { class: 'text-gray-400' }, props.label),
                h('span', { class: 'text-gray-300 dark:text-gray-600' }, '—'),
            ]);
        };
    },
});

export default {
    components: { InfoRow, SocialRow },
};
</script>

<style scoped>

   
</style>