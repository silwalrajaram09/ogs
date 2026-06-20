<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    LayoutGrid,
    Users,
    UserRound,
    Layers,
    StickyNote,
    BookOpen
} from 'lucide-vue-next';

import AppLogo from '@/components/AppLogo.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';

import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';

import type { NavItem } from '@/types';

const adminNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Committees',
        href: '/admin/committees',
        icon: UserRound,
    },
    {
        title: 'Programs',
        href: '/admin/programs',
        icon: BookOpen,
    },
    {
        title: 'Pages',
        href: '/admin/pages',
        icon: Layers,
    },
    {
        title: 'Posts',
        href: '/admin/posts',
        icon: StickyNote,
    },
    {
        title: 'Users',
        href: '/admin/users',
        icon: Users,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton
                        size="lg"
                        as-child
                    >
                        <Link href="/admin/dashboard">
                            <AppLogo />
                            
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="adminNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
</template>