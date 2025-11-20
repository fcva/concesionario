<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    productos: Object,
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Productos
            </h2>
            
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div>
                    <br>
                    <Link :href="route('producto.create' )" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrar un nuevo producto</Link>
                </div>
                <div>
                    <br>
                    <div>
                        <table class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 text-left">Codigo</th>
                                    <th class="px-4 py-2 text-left">Nombre</th>
                                    <th class="px-4 py-2 text-left">Marca</th>
                                    <th class="px-4 py-2 text-left">Modelo</th>
                                    <th class="px-4 py-2 text-left">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in productos.data" :key="producto.id"  class="border-b">
                                    <td class="px-4 py-2">
                                        {{ producto.codigo }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ producto.nombre }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ producto.marca }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ producto.modelo }}
                                    </td>
                                    <td> <Link :href="route('producto.edit', producto)" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
