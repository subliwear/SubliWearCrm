<button {{ $attributes->merge(['type' => 'submit', 'class' => 'relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-slate-600 to-slate-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text border-2 border-slate-200']) }}>
    {{ $slot }}
</button>
