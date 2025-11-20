<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props=defineProps({
    provider:{
        type: Object,
        required: true,
    },
});

const formulario=useForm({
    nombre: props.provider.nombre,
    direccion: props.provider.direccion ,
    telefono: props.provider.telefono,
});

const submitProvider = () => {
    // Lógica para enviar el formulario
    formulario.put(route('provider.update', props.provider), {
        onSuccess: () => {
            console.log('Provider actualizado con éxito!');
        },
        onError: (errors) => {
            console.error('Errores de validación:', errors);
        }
    })
};
</script>

<template>
    <Head title="ProviderEdit" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Providers Edit
            </h2>
            
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div>
                    <form class="w-full max-w-sm mx-auto" @submit.prevent="submitProvider">
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                            Nombre
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" placeholder="Nombre de proveedor" required v-model="formulario.nombre">
                        </div>
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="direccion">
                            Direccion
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="direccion" type="text" placeholder="Direccion del proveedor" required v-model="formulario.direccion">
                        </div>
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">
                            Telefono
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefono" type="tel" placeholder="Telefono del proveedor" required v-model="formulario.telefono">
                        </div>
                        <div class="flex items-center justify-between">
                          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Actualizar
                          </button>
                          <Link :href="route('provider.index' )" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Salir</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
