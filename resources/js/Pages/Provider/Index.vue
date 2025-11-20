<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
import { useModalStore } from '@/Stores/modalStore';
import ModalApp from '@/Components/ModalApp.vue';
import { ref, defineProps } from 'vue';

const modalStore = useModalStore()

const props = defineProps({
    providers: Object,
})

// console.log(props.providers);


const modalAction = ref('')

const formProvider = useForm({
    raz_soc:    '',
    nombre:     '',
    direccion:  '',
    telefono:   '',
    correo:     '',
    descripcion:'',
})

const showCreateModalProvider = () => {

    modalAction.value = 'create'
    modalStore.openModal('Nuevo Proveedor', '', modalAction.value)
}

const createProvider = () => {

    const url = route('providers.store')
    
    formProvider.post(url, {
        
        onSuccess: (response) => {

            // console.log(response);
            closeModalApp()
        }
    })
}

const showEditModalProvider = (provider) => {
    modalAction.value = 'edit'
    Object.assign(formProvider, provider)
    modalStore.openModal('Editar Proveedor', '', modalAction.value)
}

const updateProvider = () => {

    const url = route('providers.update', formProvider)

    formProvider.put(url, {

        preserveScroll: true,

        onSuccess: (response) => {

            closeModalApp()
        }
    })
}

const showDeleteModalProvider = (provider) => {
    modalAction.value = 'delete'
    Object.assign(formProvider, provider)
    modalStore.openModal('Eliminar Proveedor', '', modalAction.value)
}

const destroyProvider = () => {

    const url = route('providers.destroy', formProvider)

    formProvider.delete(url, {

        preserveScroll: true,

        onSuccess: (response) => {

            closeModalApp()
        }
    })
}

const closeModalApp = () => {
    
    formProvider.reset()
    formProvider.clearErrors()
    modalStore.closeModal()
}

</script>

<template>
    <Head title="Proveedores" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Proveedores
            </h2>
            
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <div class="overflow-hidden bg-white shadow-sm">
                    <div class="flex justify-between items-center mb-3">
                        <button
                            @click="showCreateModalProvider"
                            class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow-md transition">
                            Nuevo
                        </button>
                    </div>
                </div>


                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="min-w-full bg-white ">
                            <tbody class="divide-y divide-gray-200 ">

                                <tr v-for="provider in providers.data" :key="provider.id" class="hover:bg-gray-100">

                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ provider.nombre }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ provider.direccion }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ provider.telefono }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm space-x-2">
                                        <button @click="showEditModalProvider(provider)" class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded-md transition">
                                            Editar
                                        </button>

                                        <button @click="showDeleteModalProvider(provider)" class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-md transition">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <ModalApp>
                    <template #default>
                        <div v-if="modalAction === 'create'">
                            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-700">
                                <div class="px-4 py-3 border-b border-gray-100 border-gray-700 bg-gray-50 bg-gray-700/30">
                                    <h3 class="text-lg uppercase font-bold text-gray-800 text-white flex items-center">
                                        {{ modalStore.modalContent.title }}
                                    </h3>
                                </div>
                                <div class="p-3 space-y-2">
                                    <form @submit.prevent="createProvider">

                                        <input
                                            type="text"
                                            v-model="formProvider.nombre"
                                            placeholder="Nombre"
                                            autocomplete="off"
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
                                            v-on:focus="formProvider.clearErrors()"
                                        />

                                        <div v-if="formProvider.errors.nombre" class="text text-red-500">
                                            {{ formProvider.errors.nombre }}
                                        </div>

                                        <input
                                            type="text"
                                            v-model="formProvider.direccion"
                                            placeholder="Dirección"
                                            autocomplete="off"
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
                                        />

                                        <div class="flex justify-end space-x-2">

                                            <button
                                                type="submit"
                                                class="px-4 py-2 bg-green-600 text-white rounded-lg"
                                            >
                                                Guardar
                                            </button>

                                            <button
                                                type="button"
                                                @click="closeModalApp"
                                                class="px-4 py-2 bg-gray-500 text-white rounded-lg"
                                            >
                                                Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div v-else-if="modalAction === 'edit'">
                            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-700">
                                <div class="px-4 py-3 border-b border-gray-100 border-gray-700 bg-gray-50 bg-gray-700/30">
                                    <h3 class="text-lg uppercase font-bold text-gray-800 text-white flex items-center">
                                        {{ modalStore.modalContent.title }}
                                    </h3>
                                </div>
                                <div class="p-3 space-y-2">
                                    <form @submit.prevent="updateProvider">

                                        <input
                                            type="text"
                                            v-model="formProvider.nombre"
                                            placeholder="Nombre"
                                            autocomplete="off"
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
                                            v-on:focus="formProvider.clearErrors()"
                                        />

                                        <input
                                            type="text"
                                            v-model="formProvider.direccion"
                                            placeholder="Dirección"
                                            autocomplete="off"
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
                                        />

                                        <div class="flex justify-end space-x-2">

                                            <button
                                                type="submit"
                                                class="px-4 py-2 bg-yellow-600 text-white rounded-lg"
                                            >
                                                Guardar
                                            </button>

                                            <button
                                                type="button"
                                                @click="closeModalApp"
                                                class="px-4 py-2 bg-gray-500 text-white rounded-lg"
                                            >
                                                Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div v-else-if="modalAction === 'delete'">
                            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-700">
                                <div class="px-4 py-3 border-b border-gray-100 border-gray-700 bg-gray-50 bg-gray-700/30">
                                    <h3 class="text-lg uppercase font-bold text-gray-800 text-white flex items-center">
                                        {{ modalStore.modalContent.title }}
                                    </h3>
                                </div>
                                <div class="p-3 space-y-2">
                                    <form @submit.prevent="destroyProvider">

                                        <input
                                            type="text"
                                            v-model="formProvider.nombre"
                                            placeholder="Nombre"
                                            autocomplete="off"
                                            readonly
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
                                            v-on:focus="form.clearErrors()"
                                        />

                                        <div class="flex justify-end space-x-2">

                                            <button
                                                type="submit"
                                                class="px-4 py-2 bg-red-600 text-white rounded-lg"
                                            >
                                                Eliminar
                                            </button>

                                            <button
                                                type="button"
                                                @click="closeModalApp"
                                                class="px-4 py-2 bg-gray-500 text-white rounded-lg"
                                            >
                                                Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </template>
                </ModalApp>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
