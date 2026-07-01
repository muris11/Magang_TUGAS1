<x-app-layout>
    <div class="pt-32 pb-40" x-data="inventoryApp()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-16 flex flex-col md:flex-row justify-between items-end gap-10">
                <div class="w-full md:w-1/2">
                    <div class="inline-block px-3 py-1 rounded-full bg-black/5 border border-black/5 text-[10px] uppercase tracking-[0.2em] font-medium mb-6">
                        System Database
                    </div>
                    <h1 class="text-5xl md:text-7xl font-bold tracking-tighter text-[#050505] font-[Geist] leading-none" style="letter-spacing: -0.04em;">
                        Inventory<br/>
                        <span class="text-black/30">Registry.</span>
                    </h1>
                    <div class="mt-4 flex items-center gap-2" x-show="loadTime > 0">
                        <div class="px-2.5 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-600 text-xs font-bold font-mono tracking-tight flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            Query Execution: <span x-text="loadTime + 'ms'"></span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/2 flex flex-col sm:flex-row gap-4 items-end justify-end">
                    
                    <div class="p-1.5 rounded-[2rem] bg-black/5 border border-black/5 w-full sm:w-auto">
                        <div class="relative bg-white rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)] overflow-hidden flex items-center px-4 h-14">
                            <svg class="h-5 w-5 text-black/40 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/></svg>
                            <input 
                                type="text" 
                                x-model="searchQuery" 
                                @input.debounce.500ms="fetchData(true)"
                                placeholder="Search registry..." 
                                class="w-full border-none focus:ring-0 text-base font-medium placeholder-black/30 bg-transparent px-3 py-2"
                            >
                        </div>
                    </div>
                    
                    <div class="p-1.5 rounded-[2rem] bg-black/5 border border-black/5 w-full sm:w-auto flex flex-row gap-1.5 shrink-0 overflow-x-auto">
                        <div class="relative bg-white rounded-[calc(2rem-0.375rem)] h-14 px-3 flex items-center shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
                            <select x-model="kategori" @change="fetchData(true)" class="border-none focus:ring-0 text-sm font-medium text-black/70 bg-transparent cursor-pointer pl-2 pr-8 appearance-none w-32">
                                <option value="">All Categories</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Pakaian">Pakaian</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Otomotif">Otomotif</option>
                                <option value="Kesehatan">Kesehatan</option>
                                <option value="Kecantikan">Kecantikan</option>
                            </select>
                        </div>
                        <div class="relative bg-white rounded-[calc(2rem-0.375rem)] h-14 px-3 flex items-center shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
                            <select x-model="sort" @change="fetchData(true)" class="border-none focus:ring-0 text-sm font-medium text-black/70 bg-transparent cursor-pointer pl-2 pr-8 appearance-none w-32">
                                <option value="terbaru">Latest</option>
                                <option value="terlama">Oldest</option>
                                <option value="harga_tinggi">Highest Price</option>
                                <option value="harga_rendah">Lowest Price</option>
                            </select>
                        </div>
                        <div class="relative bg-white rounded-[calc(2rem-0.375rem)] h-14 px-3 flex items-center shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
                            <select x-model="limit" @change="fetchData(true)" class="border-none focus:ring-0 text-sm font-medium text-black/70 bg-transparent cursor-pointer pl-2 pr-8 appearance-none w-24">
                                <option value="10">10 / pg</option>
                                <option value="20">20 / pg</option>
                                <option value="50">50 / pg</option>
                                <option value="100">100 / pg</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="hidden md:grid grid-cols-12 gap-4 px-8 pb-4 text-xs font-semibold tracking-[0.1em] text-black/40 uppercase mb-2 border-b border-black/5">
                <div class="col-span-2">ID</div>
                <div class="col-span-4">Product Name</div>
                <div class="col-span-2">Category</div>
                <div class="col-span-2 text-right">Stock</div>
                <div class="col-span-2 text-right">Value</div>
            </div>

            <div class="flex flex-col gap-4 relative" style="min-height: 60vh;">
                
                <template x-for="(item, index) in items" :key="item.id">
                    <div class="group p-1.5 rounded-[1.5rem] bg-transparent hover:bg-black/5 border border-transparent hover:border-black/5 transition-colors cursor-default">
                        <div class="bg-white rounded-[calc(1.5rem-0.375rem)] px-6 py-5 shadow-sm border border-black/[0.03] flex flex-col md:grid md:grid-cols-12 gap-4 items-center group-hover:scale-[0.99] group-active:scale-[0.97] transition-transform duration-300">
                            
                            <div class="col-span-12 md:col-span-2 w-full flex justify-between md:block">
                                <span class="md:hidden text-xs text-black/40 font-medium">ID</span>
                                <span class="text-sm font-semibold text-black/30 font-mono tracking-tight" x-text="item.kode_barang"></span>
                            </div>
                            
                            <div class="col-span-12 md:col-span-4 w-full flex justify-between md:block items-center">
                                <span class="md:hidden text-xs text-black/40 font-medium">Name</span>
                                <span class="text-lg md:text-base font-semibold text-black tracking-tight" x-text="item.nama_barang"></span>
                            </div>
                            
                            <div class="col-span-12 md:col-span-2 w-full flex justify-between md:block">
                                <span class="md:hidden text-xs text-black/40 font-medium">Category</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FDFBF9] border border-black/5 text-black/60 tracking-wider uppercase" x-text="item.kategori"></span>
                            </div>
                            
                            <div class="col-span-12 md:col-span-2 w-full flex justify-between md:justify-end md:text-right">
                                <span class="md:hidden text-xs text-black/40 font-medium">Stock</span>
                                <span class="text-base font-medium text-black/70 flex items-center gap-2">
                                    <span x-text="item.stok"></span>
                                    <span class="w-1.5 h-1.5 rounded-full" :class="item.stok > 10 ? 'bg-green-400' : 'bg-red-400'"></span>
                                </span>
                            </div>
                            
                            <div class="col-span-12 md:col-span-2 w-full flex justify-between md:justify-end md:text-right">
                                <span class="md:hidden text-xs text-black/40 font-medium">Value</span>
                                <span class="text-base font-medium text-black font-mono tracking-tight" x-text="formatRupiah(item.harga)"></span>
                            </div>
                            
                        </div>
                    </div>
                </template>
                
                <div x-show="loading" class="py-20 flex justify-center w-full">
                    <div class="px-6 py-3 rounded-full bg-black/5 text-sm font-medium text-black/60 tracking-wide flex items-center gap-3">
                        <svg class="animate-spin h-4 w-4 text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><line x1="128" y1="32" x2="128" y2="64" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="195.88" y1="59.12" x2="173.25" y2="81.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="224" y1="128" x2="192" y2="128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="195.88" y1="196.88" x2="173.25" y2="174.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="128" y1="224" x2="128" y2="192" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="60.12" y1="196.88" x2="82.75" y2="174.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="32" y1="128" x2="64" y2="128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="60.12" y1="59.12" x2="82.75" y2="81.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        Retrieving Data...
                    </div>
                </div>

                <div x-show="!loading && items.length === 0" class="py-32 flex flex-col items-center justify-center">
                    <div class="p-2 rounded-full bg-black/5 mb-6">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center shadow-sm">
                            <svg class="h-6 w-6 text-black/20" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M104,144l48,48"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M152,144l-48,48"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z"/><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" points="152 32 152 88 208 88"/></svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-semibold text-black mb-2">No Records Found</h3>
                    <p class="text-black/40">Adjust your search or filter parameters to find entries.</p>
                </div>
                
                <!-- Pagination -->
                <div x-show="lastPage > 1 && !loading" class="mt-8 flex flex-col md:flex-row justify-between items-center gap-6 py-6 border-t border-black/5">
                    <div class="text-sm text-black/50 font-medium">
                        Showing <span class="text-black/80 font-bold" x-text="from"></span> to <span class="text-black/80 font-bold" x-text="to"></span> of <span class="text-black/80 font-bold" x-text="total"></span> results
                    </div>
                    <div class="flex items-center gap-2">
                        <button 
                            @click="if (page > 1) { page--; fetchData(); }"
                            :disabled="page === 1"
                            class="px-4 py-2 rounded-full border border-black/5 text-sm font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed hover:bg-black/5"
                        >
                            Previous
                        </button>
                        
                        <div class="flex items-center gap-1 mx-2">
                            <template x-for="p in getPageNumbers()" :key="p">
                                <button 
                                    @click="if (p !== '...') { page = p; fetchData(); }"
                                    :class="p === page ? 'bg-black text-white' : (p === '...' ? 'text-black/40 cursor-default' : 'text-black/60 hover:bg-black/5')"
                                    class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-colors font-mono"
                                    x-text="p"
                                    :disabled="p === '...'"
                                ></button>
                            </template>
                        </div>

                        <button 
                            @click="if (page < lastPage) { page++; fetchData(); }"
                            :disabled="page === lastPage"
                            class="px-4 py-2 rounded-full border border-black/5 text-sm font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed hover:bg-black/5"
                        >
                            Next
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('inventoryApp', () => ({
                items: [],
                searchQuery: '',
                kategori: '',
                sort: 'terbaru',
                limit: 50,
                page: 1,
                lastPage: 1,
                total: 0,
                from: 0,
                to: 0,
                loading: false,
                fetching: false,
                loadTime: 0,

                init() {
                    this.fetchData();
                },

                async fetchData(resetPage = false) {
                    if (this.fetching) return;
                    if (resetPage) this.page = 1;

                    this.loading = true;
                    this.fetching = true;
                    this.items = [];

                    try {
                        const startTime = performance.now();

                        let url = `/barang/data?limit=${this.limit}&page=${this.page}`;
                        if (this.searchQuery) url += `&search=${encodeURIComponent(this.searchQuery)}`;
                        if (this.kategori) url += `&kategori=${encodeURIComponent(this.kategori)}`;
                        if (this.sort) url += `&sort=${encodeURIComponent(this.sort)}`;

                        const response = await fetch(url, {
                            credentials: 'same-origin',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });
                        
                        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                        const data = await response.json();

                        const endTime = performance.now();
                        this.loadTime = (endTime - startTime).toFixed(0);

                        this.items = data.data;
                        this.page = data.current_page || 1;
                        this.lastPage = data.last_page || 1;
                        this.total = data.total || 0;
                        this.from = data.from || 0;
                        this.to = data.to || 0;

                    } catch (error) {
                        console.error("Gagal memuat data:", error);
                    } finally {
                        this.loading = false;
                        this.fetching = false;
                    }
                },

                getPageNumbers() {
                    let current = this.page,
                        last = this.lastPage,
                        delta = 2,
                        left = current - delta,
                        right = current + delta + 1,
                        range = [],
                        rangeWithDots = [],
                        l;

                    for (let i = 1; i <= last; i++) {
                        if (i == 1 || i == last || i >= left && i < right) {
                            range.push(i);
                        }
                    }

                    for (let i of range) {
                        if (l) {
                            if (i - l === 2) {
                                rangeWithDots.push(l + 1);
                            } else if (i - l !== 1) {
                                rangeWithDots.push('...');
                            }
                        }
                        rangeWithDots.push(i);
                        l = i;
                    }
                    return rangeWithDots;
                },
                
                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
                }
            }));
        });
    </script>
</x-app-layout>
