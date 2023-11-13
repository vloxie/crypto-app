<template>
    <div class="text-center mb-10 mt-5">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Crypto <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">Top 10</mark> Currencies</h1>
        <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Check out the top ten crypto currencies based on market cap below</p>
    </div>
    <div v-if="pending && !error" role="status" class="w-full p-10">
        <svg aria-hidden="true" class="mx-auto w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="sr-only">Loading...</span>
    </div>
    <div v-if="!pending && !error" class="pb-4 flex justify-end">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" v-model="query" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for currency in top 10">
        </div>
    </div>
    <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ showError }} </span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
    </div>
    <table v-if="!pending && !error" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Crypto Currency
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Current Price
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Market Cap
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Market Cap change (24h)
            </th>
            <th scope="col" class="px-6 py-3">
                Market Cap Change Percentage (24h)
            </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="crypto in cryptoCurrencies"
            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <div class="flex items-center gap-2">
                    <img :src="crypto.image" :alt="crypto.name" class="h-6"><span>{{ crypto.name }}</span><span>({{ crypto.symbol.toUpperCase() }})</span>
                </div>
            </th>
            <td class="px-6 py-4 text-center">
                <span v-html="currencySymbol('gbp')"></span>{{ crypto.current_price }}
            </td>
            <td class="px-6 py-4 text-center">
                {{ crypto.market_cap }}
            </td>
            <td class="px-6 py-4 text-center">
                {{ crypto.market_cap_change_24h }}
            </td>
            <td class="px-6 py-4 text-center">
                {{ crypto.market_cap_change_percentage_24h }}
            </td>
            <td class="px-6 py-4">
                <NuxtLink :to="'/crypto/' + crypto.id"
                          class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View
                </NuxtLink>
            </td>
        </tr>
        </tbody>
    </table>
</template>
<script setup lang="ts">
const query = ref();
const showError = ref('');
const { pending, data, error } = await useFetch('http://backend.localhost/api/list', {
    lazy: true,
    server: false,
    async onResponseError({ request, response, options }) {
        showError.value = response._data.error
    },
})

const cryptoCurrencies = computed(() => {
    if(!query.value){
        return data.value
    }

    return data.value.filter((item) => {
        return item.name.toLowerCase().startsWith(query.value.toLowerCase()) || item.symbol.toLowerCase().startsWith(query.value.toLowerCase());
    })
})

</script>
