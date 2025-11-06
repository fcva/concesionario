<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import { useModalStore } from '@/Stores/modalStore';
// import ModalApp from '@/Components/ModalApp.vue';
import ModalApp from '@/Components/ModalApp.vue';
import { ref } from 'vue';

const modalStore = useModalStore()

defineProps({
    compras: Object,
})

const { props } = usePage()

/**
 * Producto
 */
const productos = ref(props.productos ?? { data: [] })
const loadingProductos = ref(false)
// const selectedProducto = ref('')

function loadProductos() {

  if (productos.value.data && productos.value.data.length > 0) return

  loadingProductos.value = true

  router.reload({
    only: ['productos'], // carga solo la prop lazy 'productos'
    onFinish: () => {
      // actualizamos con la nueva data del servidor
      productos.value = usePage().props.productos
      loadingProductos.value = false
    },
  })
}






const modalAction = ref('')

const form = useForm({
    producto_id:    '',
    cantidad:       '',
    precio_compra:  ''
})

const showCreateModalUsuario = () => {
    modalAction.value = 'create'
    modalStore.openModal('Nueva Compra', '', modalAction.value)    
}

const createCompra = () => {
    
    // console.log(form);

    const url = route('compras.store')
    
    form.post(url, {
        
        onSuccess: (response) => {

            // console.log('Returning from back... '+Object.keys(response.props.users.data));
            console.log('Returning from back... '+response.props.users.data)

            closeModalApp()
        }
    })
}

const showEditModalUsuario = (item) => {
    modalAction.value = 'edit'
    Object.assign(form, item)
    modalStore.openModal('Editar Usuario', '', modalAction.value)
}

const editUsuario = () => {

    /*const url = route('acl.usuario.update', form)

    form.put(url, {

        preserveScroll: true,

        onSuccess: (response) => {            

            form.reset()
            closeModalApp()
        }
    })*/
}



const showDeleteModalUsuario = (item) => {
    modalAction.value = 'delete'
    Object.assign(form, item)
    modalStore.openModal('Eliminar Usuario', '', modalAction.value)
}

const deleteUsuario = () => {

    /*const url = route('acl.usuario.destroy', form)

    form.delete(url, {

        preserveScroll: true,

        onSuccess: () => {

            form.reset()
            
            closeModalApp()
        }
    })*/
}

const closeModalApp = () => {
    
    form.reset()
    form.clearErrors()
    modalStore.closeModal()
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Usuarios
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                <div class="overflow-hidden bg-white shadow-sm">
                    <div class="flex justify-between items-center mb-3">
                        <button
                            @click="showCreateModalUsuario"
                            class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow-md transition">
                            Nuevo
                        </button>
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="min-w-full bg-white ">
                            <tbody class="divide-y divide-gray-200 ">
                                <tr v-for="compra in compras.data" :key="compra.id" class="hover:bg-gray-100">

                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ compra.persona.nombres }} {{ compra.persona.apellidos }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ compra.fecha }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ compra.detalleCompras }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm space-x-2">
                                        <button @click="showEditModalUsuario(compra)" class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium rounded-md transition">
                                            Editar
                                        </button>

                                        <button @click="showDeleteModalUsuario(compra)" class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-md transition">
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
                                    <form @submit.prevent="createCompra">


                                        <div>
                                            <label for="persona" class="block mb-2 font-semibold">Seleccionar Productos</label>

                                            <select
                                                id="persona"
                                                class="form-select text-gray-700 border rounded p-2 mb-3 w-full"
                                                v-model="form.producto_id"
                                                @focus="loadProductos"
                                            >
                                                <option value="">-- Seleccionar --</option>
                                                <option
                                                v-for="producto in productos.data ?? []"
                                                :key="producto._id"
                                                :value="producto._id"
                                                >
                                                {{ producto.codigo }} {{ producto.nombre }} {{ producto.marca }}
                                                </option>
                                            </select>

                                            <p v-if="loadingProductos" class="text-gray-500 mt-2">Cargando productos...</p>
                                        </div>










                                        <input
                                            type="text"
                                            v-model="form.cantidad"
                                            placeholder="Cantidad"
                                            autocomplete="off"
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
                                            v-on:focus="form.clearErrors()"
                                        />

                                        <input
                                            type="text"
                                            v-model="form.precio_compra"
                                            placeholder="Precio de Compra"
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
                                    <form @submit.prevent="editUsuario">

                                        <input
                                            type="text"
                                            v-model="form.name"
                                            placeholder="Nombre"
                                            autocomplete="off"
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
                                            v-on:focus="form.clearErrors()"
                                        />

                                        <input
                                            type="email"
                                            v-model="form.email"
                                            placeholder="Email"
                                            autocomplete="off"
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
                                        />

                                        <input
                                            type="text"
                                            v-model="form.password"
                                            value="password"
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
                                    <form @submit.prevent="deleteUsuario">

                                        <input
                                            type="text"
                                            v-model="form.name"
                                            placeholder="Nombre"
                                            autocomplete="off"
                                            readonly
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
                                            v-on:focus="form.clearErrors()"
                                        />

                                        <input
                                            type="email"
                                            v-model="form.email"
                                            placeholder="Email"
                                            readonly
                                            autocomplete="off"
                                            class="w-full text-gray-700 p-2 mb-3 border rounded-lg"
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