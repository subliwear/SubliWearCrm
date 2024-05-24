<template>
    <div class="flex w-7/12" :class="[message.is_from_customer?'':' ml-auto']">
        <div>
            <img v-if="message.is_from_customer" :src="'https://api.dicebear.com/6.x/notionists-neutral/svg?seed='+customer.email" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-circle border" alt="user1" />
            <img v-else :src="'https://api.dicebear.com/6.x/notionists-neutral/svg?seed='+manager.email" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-circle border" alt="user1" />
        </div>
        <div class="p-4 rounded-xl w-full mb-4" :class="[message.is_from_customer?'bg-green':'bg-gray']">
            <div v-if="message.is_from_customer" class="mb-1 font-semibold leading-normal text-sm text-slate-700">{{ customer.name }}</div>
            <div v-else class="mb-1 font-semibold leading-normal text-sm text-slate-700">{{ manager.name }}</div>
            <div v-if="!message.is_custom" class="text-md">User selected patronage</div>
            <div v-else class="text-md">User uploaded own patronage</div>

            <!--patronage-->
            <div class="bg-white/80 border border-slate-200 mb-4 mt-4 p-4 rounded flex flex-wrap flex-grow-0 flex-shrink-0 gap-10" v-if="message.is_custom">
                <div class="border rounded p-4" v-for="dnld in message.downloads">
                    <div v-if="dnld.filetype.includes('image/')" class="w-32 h-32 rounded border flex">
                        <img :src="dnld.url" alt="" class="w-full object-fit" >
                    </div>
                    <div>
                        <a :href="dnld.url" target="_blank"  download class="text-blue-800 text-sm"><svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg> <span class="underline">Download</span></a>
                        &nbsp;
                        <a :href="dnld.url" target="_blank"   class="text-blue-800 text-sm"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 24 24"><path d="M12 5.5c-3.45 0-6.643 1.768-8.484 4.699-1.851 2.932-1.935 6.613-.25 9.527.253.399.546.768.869 1.106a.75.75 0 01-.117 1.053.808.808 0 01-.097.07 11.943 11.943 0 01-1.154.947c-.539.365-1.096.686-1.668.966A1.014 1.014 0 01.75 22h-.5a.75.75 0 01-.75-.75v-.5c0-.323.203-.6.497-.707.37-.122.718-.284 1.041-.49a11.929 11.929 0 011.141-.757.994.994 0 01.276-.097.75.75 0 01.883.665c.137.81.384 1.604.738 2.366.091.194.191.382.299.565a.75.75 0 01-.044.815 19.903 19.903 0 01-.894 1.158 11.965 11.965 0 01-3.127 2.845.75.75 0 01-.686-1.326A10.533 10.533 0 007.66 15.5c.284-.441.599-.868.945-1.278.05-.06.1-.12.152-.18.15-.176.305-.346.467-.507a.75.75 0 011.025-.083A10.426 10.426 0 0012 13.5c2.725 0 5.217 1.044 7.101 2.771a.75.75 0 11-.95 1.146A12.175 12.175 0 0112 14.5c-2.203 0-4.247.693-5.95 1.869a.75.75 0 11-.944-1.167C7.489 14.638 9.62 13.5 12 13.5c1.52 0 2.949.345 4.222.945.008.004.016.004.024.007a.75.75 0 01.195 1.43c-.066.014-.136.018-.201.03-.062.012-.125.025-.188.035-.25.047-.502.085-.758.112-.194.022-.383.07-.57.118-.297.09-.598.163-.9.213-.026.005-.052.005-.078.01-.07.015-.14.028-.21.042a.75.75 0 01-.675-.352 15.28 15.28 0 01-.42-.647 20.173 20.173 0 01-1.18-2.183 20.186 20.186 0 01-.505-1.118 15.087 15.087 0 01-.44-1.23.75.75 0 01.175-.741A11.996 11.996 0 0112 5.5zm0 2c-.2 0-.4.01-.6.033a.75.75 0 01-.5.15c-.017 0-.034.005-.051.005a.75.75 0 01-.748-.648c-.033-.37.034-.744.191-1.09a.75.75 0 01.648-.442c.33-.02.656-.067.976-.143a.75.75 0 01.507.134c.19.132.403.242.632.325.139.234.287.46.442.68.248.277.52.54.81.782.121.104.253.188.392.26.061.031.123.06.186.087.188.08.382.143.578.186.062.016.124.032.188.045.19.04.384.065.578.065.2 0 .4-.02.6-.057.157-.031.313-.073.468-.122.224-.07.444-.152.658-.255.273-.123.532-.268.78-.426.006-.003.012-.002.018-.005a12.47 12.47 0 01.635-.317c.215-.103.426-.215.63-.335.262-.152.507-.324.748-.51.127-.098.252-.202.376-.306.002-.001.002-.003.004-.004a.75.75 0 01.667-.106c.315.073.62.174.915.298a11.722 11.722 0 01.942.437c.208.106.409.225.605.355.104.068.21.13.31.203a.75.75 0 01-.321 1.438c-.074-.026-.15-.048-.225-.072a.75.75 0 01-.51-.61c-.09-.73-.343-1.43-.748-2.074a.75.75 0 01-.052-.07c-.284-.324-.625-.585-.997-.77A13.54 13.54 0 0012 7.5zm-5.25 2.25a.75.75 0 01.75-.75h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-1.5 0v-5.25a.75.75 0 01.75-.75h-1.5a.75.75 0 01-.75.75v5.25a.75.75 0 01-1.5 0v-5.25zm3.75 0a.75.75 0 01.75-.75h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-1.5 0v-5.25a.75.75 0 01.75-.75h-1.5a.75.75 0 01-.75.75v5.25a.75.75 0 01-1.5 0v-5.25zm3.75 0a.75.75 0 01.75-.75h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-1.5 0v-5.25a.75.75 0 01.75-.75h-1.5a.75.75 0 01-.75.75v5.25a.75.75 0 01-1.5 0v-5.25z"/></svg><span class="underline">Show</span></a>
                    </div>
                    
                </div>
                <detailsBlock :details="message.details" :columns="message.columns" />
            </div>
            <div class="bg-white/80 border border-slate-200 mb-4 mt-4 p-4 rounded flex flex-wrap flex-grow-0 flex-shrink-0 gap-10" v-else>
                <div class="font-bold w-full">
                    {{ message.patronage.title }}
                </div>
                <div class="border rounded p-4">
                    <div class="w-32 h-32 rounded border flex">
                        <img :src="message.patronage.preview" alt="" class="w-full object-fit" >
                    </div>

                    <div v-if="message.patronage.download!=='' && message.patronage.download!==null && message.patronage.download!=='null'">
                        <a :href="message.patronage.download" download target="_blank" class="text-blue-800 text-sm"><svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg> <span class="underline">Download</span></a>
                        &nbsp;
                        <a :href="message.patronage.download"  target="_blank" class="text-blue-800 text-sm"><svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg> <span class="underline">Download</span></a>
                    </div>
                    
                </div>
                <patronage-with-logos :preview="message.preview" />
                <detailsBlock :details="message.details" :columns="message.columns" />
            </div>
            <!--eo patronage-->

            <div class="date text-sm .leading-tight text-right">
                {{ message.date }}
            </div>
        </div>
    </div>
</template>
<script>
    import detailsBlock from './details.vue';
    import patronageWithLogos from '../patronage-with-logos.vue';
    export default{
        components: {
            detailsBlock,
            patronageWithLogos
        },
        props: {
            customer: {
                type: Object
            },
            manager: {
                type: Object
            },
            message: {
                type: Object
            }
        },

    }
</script>