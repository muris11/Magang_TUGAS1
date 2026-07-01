<x-app-layout>
    <div class="pt-32 pb-40" x-data="dashboardMetrics()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-16">
                <div class="inline-block px-3 py-1 rounded-full bg-black/5 border border-black/5 text-[10px] uppercase tracking-[0.2em] font-medium mb-6">
                    Command Center
                </div>
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter text-[#050505] font-[Geist] leading-none" style="letter-spacing: -0.04em;">
                    System<br/>
                    <span class="text-black/30">Dashboard.</span>
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="p-1.5 rounded-[2rem] bg-black/5 border border-black/5 group cursor-default">
                    <div class="relative bg-white rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)] p-8 flex flex-col justify-between h-48 group-hover:scale-[0.98] spring-transition">
                        <div class="flex justify-between items-start">
                            <h3 class="text-black/40 text-xs font-semibold uppercase tracking-[0.15em]">Total Inventory</h3>
                            <div class="p-2 rounded-full bg-[#FDFBF9] border border-black/5 text-black/60">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32,204.44,73.75l-71.57,39.26L51.56,73.75ZM40,90l80,42.83v89L40,178.61Zm176,88.58-80,43.21V132.86l80-43.87Z"/></svg>
                            </div>
                        </div>
                        <div class="text-5xl font-bold text-black tracking-tight font-[Geist]">
                            <span x-text="metrics.total_barang ?? '...'"></span>
                        </div>
                    </div>
                </div>

                <div class="p-1.5 rounded-[2rem] bg-black/5 border border-black/5 group cursor-default">
                    <div class="relative bg-white rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)] p-8 flex flex-col justify-between h-48 group-hover:scale-[0.98] spring-transition">
                        <div class="flex justify-between items-start">
                            <h3 class="text-black/40 text-xs font-semibold uppercase tracking-[0.15em]">System Users</h3>
                            <div class="p-2 rounded-full bg-[#FDFBF9] border border-black/5 text-black/60">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,228.8a8,8,0,0,0,8.87,8.85,122.28,122.28,0,0,1,143.2,0,8,8,0,0,0,8.87-8.85A95.83,95.83,0,0,0,117.25,157.92ZM172,120a52,52,0,1,1,52-52A52.06,52.06,0,0,1,172,120Zm69.34,92.51a87.61,87.61,0,0,0-43.2-46.7,76,76,0,0,1,15,4.95,106.39,106.39,0,0,1,41,31.78,8,8,0,0,1-12.83,10Z"/></svg>
                            </div>
                        </div>
                        <div class="text-5xl font-bold text-black tracking-tight font-[Geist]">
                            <span x-text="metrics.total_user ?? '...'"></span>
                        </div>
                    </div>
                </div>

                <div class="p-1.5 rounded-[2rem] bg-black/5 border border-black/5 group cursor-default">
                    <div class="relative bg-white rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)] p-8 flex flex-col justify-between h-48 group-hover:scale-[0.98] spring-transition">
                        <div class="flex justify-between items-start">
                            <h3 class="text-black/40 text-xs font-semibold uppercase tracking-[0.15em]">Server Node</h3>
                            <div class="p-2 rounded-full bg-[#FDFBF9] border border-black/5 text-black/60">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><rect x="32" y="48" width="192" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="32" y="144" width="192" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="184" cy="80" r="12"/><circle cx="184" cy="176" r="12"/></svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold tracking-tight font-[Geist] flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" :class="metrics.server_status === 'Online' ? 'bg-green-400' : 'bg-red-400'"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3" :class="metrics.server_status === 'Online' ? 'bg-green-500' : 'bg-red-500'"></span>
                            </span>
                            <span :class="metrics.server_status === 'Online' ? 'text-black' : 'text-red-600'" x-text="metrics.server_status ?? '...'"></span>
                        </div>
                    </div>
                </div>

                <div class="p-1.5 rounded-[2rem] bg-black/5 border border-black/5 group cursor-default">
                    <div class="relative bg-white rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)] p-8 flex flex-col justify-between h-48 group-hover:scale-[0.98] spring-transition">
                        <div class="flex justify-between items-start">
                            <h3 class="text-black/40 text-xs font-semibold uppercase tracking-[0.15em]">Database</h3>
                            <div class="p-2 rounded-full bg-[#FDFBF9] border border-black/5 text-black/60">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><ellipse cx="128" cy="80" rx="88" ry="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M40,80v96c0,22.09,39.4,40,88,40s88-17.91,88-40V80"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M40,128c0,22.09,39.4,40,88,40s88-17.91,88-40"/></svg>
                            </div>
                        </div>
                        <div class="text-2xl font-bold tracking-tight font-[Geist] flex items-center gap-3">
                            <span :class="metrics.database_status === 'Connected' ? 'text-black' : 'text-red-600'" x-text="metrics.database_status ?? '...'"></span>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="mt-8 p-1.5 rounded-[2rem] bg-black/5 border border-black/5">
                <div class="relative bg-white rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)] p-10">
                    <h3 class="text-xl font-bold text-black mb-4 font-[Geist]">System Architecture</h3>
                    <p class="text-black/60 leading-relaxed text-lg">
                        This system is engineered to handle up to <strong class="text-black">1,500,000 inventory records</strong> with sub-second performance using PostgreSQL indexing, stateful API authentication, and cursor pagination.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dashboardMetrics', () => ({
                metrics: {
                    total_barang: null,
                    total_user: null,
                    server_status: null,
                    database_status: null
                },
                
                async init() {
                    try {
                        const response = await fetch('/dashboard/data', {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        const data = await response.json();
                        if(data.data) {
                            this.metrics = data.data;
                            this.metrics.total_barang = new Intl.NumberFormat('id-ID').format(this.metrics.total_barang);
                            this.metrics.total_user = new Intl.NumberFormat('id-ID').format(this.metrics.total_user);
                        }
                    } catch (error) {
                        console.error('Failed to fetch metrics:', error);
                    }
                }
            }));
        });
    </script>
</x-app-layout>
