<div x-data="{ openModal: false, openStatusModal: false, selectedEvent: null }">
    <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Agendamentos</h2>
        <button @click="openModal = true" class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded shadow text-sm font-medium">
            + Novo Agendamento
        </button>
    </div>

    <!-- Calendar Container -->
    <div class="bg-white p-6 shadow rounded-lg">
        <div id="calendar"></div>
    </div>

    <!-- Create Appointment Modal -->
    <div x-show="openModal" style="display: none;" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="openModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="openModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="openModal" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="/admin/appointments/store" method="POST">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Novo Agendamento</h3>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cliente *</label>
                            <select name="customer_id" required class="w-full border-gray-300 rounded shadow-sm p-2 border">
                                <?php foreach($customers as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Serviço *</label>
                            <select name="service_id" required class="w-full border-gray-300 rounded shadow-sm p-2 border">
                                <?php foreach($services as $s): ?>
                                    <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?> (<?= number_format($s['price'], 2, ',', '.') ?> - <?= $s['duration'] ?> min)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profissional *</label>
                            <select name="professional_id" required class="w-full border-gray-300 rounded shadow-sm p-2 border">
                                <?php foreach($professionals as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?> (<?= htmlspecialchars($p['specialty']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Data *</label>
                                <input type="date" name="appointment_date" required class="w-full border-gray-300 rounded shadow-sm p-2 border">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hora Inicial *</label>
                                <input type="time" name="start_time" required class="w-full border-gray-300 rounded shadow-sm p-2 border">
                            </div>
                        </div>

                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-900 text-base font-medium text-white hover:bg-gray-800 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Salvar
                        </button>
                        <button type="button" @click="openModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Status Change Modal -->
    <div x-show="openStatusModal" style="display: none;" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="openStatusModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="/admin/appointments/status" method="POST">
                    <input type="hidden" name="id" x-model="selectedEvent">
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Atualizar Agendamento</h3>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" required class="w-full border-gray-300 rounded shadow-sm p-2 border">
                                <option value="agendado">Agendado</option>
                                <option value="em atendimento">Em Atendimento</option>
                                <option value="concluido">Concluído</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>
                        
                        <div class="mb-4 bg-yellow-50 p-4 border border-yellow-200 rounded text-sm text-yellow-800">
                            <strong>Nota:</strong> Marcar como "Concluído" gerará a comissão do profissional.
                            Selecione a forma de pagamento abaixo (apenas se for concluir):
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Forma de Pagamento (Se concluído)</label>
                            <select name="payment_method" class="w-full border-gray-300 rounded shadow-sm p-2 border">
                                <option value="dinheiro">Dinheiro</option>
                                <option value="pix">PIX</option>
                                <option value="cartao credito">Cartão de Crédito</option>
                                <option value="cartao debito">Cartão de Débito</option>
                            </select>
                        </div>

                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 justify-between flex flex-row-reverse items-center">
                        <div class="flex">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Atualizar
                            </button>
                            <button type="button" @click="openStatusModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Fechar
                            </button>
                        </div>
                    </div>
                </form>
                
                <form action="/admin/appointments/delete" method="POST" class="bg-gray-50 px-4 py-3 border-t">
                    <input type="hidden" name="id" x-model="selectedEvent">
                    <button type="submit" onclick="return confirm('Excluir agendamento?')" class="text-red-600 text-sm hover:underline">Deletar Agendamento permanentemente</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'pt-br',
            allDayText: 'Dia Inteiro',
            buttonText: {
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                day: 'Dia'
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            slotMinTime: '08:00:00',
            slotMaxTime: '22:00:00',
            events: '/admin/appointments/api',
            eventClick: function(info) {
                // Pre-fill the alpine component modal
                var alpineData = document.querySelector('[x-data]').__x.$data;
                alpineData.selectedEvent = info.event.id;
                alpineData.openStatusModal = true;
            }
        });
        calendar.render();
    });
</script>
