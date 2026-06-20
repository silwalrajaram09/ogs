<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLogo from '@/components/AppLogo.vue';
import { dashboard, login } from '@/routes';
import { register } from '@/routes';

 

</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div
        class="min-h-screen bg-white text-slate-900 dark:bg-slate-950 dark:text-white"
    >
        <!-- Header -->
        <header class="border-b border-slate-200 dark:border-slate-800">
            <div
                class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5"
            > 
                <AppLogo/>
                <nav class="flex items-center gap-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="rounded-lg bg-blue-600 px-5 py-2 text-white transition hover:bg-blue-700"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="login()"
                            class="rounded-lg px-5 py-2 text-slate-700 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
                        >
                            Login
                        </Link>

                        <Link
                            :href="register()"
                            class="rounded-lg bg-blue-600 px-5 py-2 text-white transition hover:bg-blue-700"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <main
            class="mx-auto flex min-h-[calc(100vh-80px)] max-w-7xl items-center px-6"
        >
            <div class="grid w-full gap-12 lg:grid-cols-2 lg:items-center">
                <!-- Left Content -->
                <div>
                    <span
                        class="rounded-full bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400"
                    >
                        Laravel + Vue + Inertia
                    </span>

                    <h2
                        class="mt-6 text-5xl font-bold leading-tight lg:text-6xl"
                    >
                        Build Modern Web Applications Faster
                    </h2>

                    <p
                        class="mt-6 max-w-xl text-lg text-slate-600 dark:text-slate-400"
                    >
                        Create scalable, secure, and high-performance web
                        applications using Laravel, Vue.js, and Inertia.js.
                        Everything you need to launch your next project.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <Link
                            v-if="!$page.props.auth.user"
                            :href="register()"
                            class="rounded-lg bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700"
                        >
                            Get Started
                        </Link>

                        <Link
                            v-if="!$page.props.auth.user"
                            :href="login()"
                            class="rounded-lg border border-slate-300 px-6 py-3 font-medium hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-900"
                        >
                            Login
                        </Link>

                        <Link
                            v-if="$page.props.auth.user"
                            :href="dashboard()"
                            class="rounded-lg bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700"
                        >
                            Go to Dashboard
                        </Link>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="flex justify-center">
                    <div
                        class="w-full max-w-lg rounded-3xl border border-slate-200 bg-white p-8 shadow-xl dark:border-slate-800 dark:bg-slate-900"
                    >
                        <div
                            class="mb-6 h-3 w-32 rounded bg-blue-500"
                        ></div>

                        <div class="space-y-4">
                            <div
                                class="h-4 rounded bg-slate-200 dark:bg-slate-700"
                            ></div>
                            <div
                                class="h-4 w-5/6 rounded bg-slate-200 dark:bg-slate-700"
                            ></div>
                            <div
                                class="h-4 w-4/6 rounded bg-slate-200 dark:bg-slate-700"
                            ></div>

                            <div
                                class="mt-8 rounded-xl bg-blue-600 p-6 text-white"
                            >
                                <h3 class="text-lg font-semibold">
                                    Modern Development Stack
                                </h3>
                                <p class="mt-2 text-blue-100">
                                    Laravel • Vue 3 • Inertia • Tailwind CSS
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>