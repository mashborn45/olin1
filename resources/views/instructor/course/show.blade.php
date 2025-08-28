{{-- resources/views/courses/show.blade.php --}}

<x-layout>
    <x-slot name="title">
        {{ $course->title }} - Course Details
    </x-slot>

    <div class="relative min-h-screen bg-gray-900 text-gray-100">

        <div class="absolute inset-0 z-0 opacity-10">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
                        <path d="M 32 0 L 0 0 0 32" fill="none" stroke="currentColor" stroke-width="0.5"></path>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="relative z-10 p-8 md:p-12">

            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-400 mb-2">{{ $course->title }}</h1>
                <p class="text-lg text-gray-400 mb-1">Code: <span class="text-blue-300 font-mono">{{ $course->course_code }}</span></p>
                <p class="text-lg text-gray-400">Instructor: <span class="text-white font-medium">{{ $course->instructor->name ?? 'N/A' }}</span></p>
            </div>

            {{-- Display success message --}}
            @if (session('success'))
                <div class="bg-green-700 bg-opacity-30 border border-green-500 text-green-300 px-6 py-4 rounded-lg relative mb-6 backdrop-blur-sm" role="alert">
                    <span class="block">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
                <button
                    type="button"
                    class="group relative overflow-hidden flex-1 w-full sm:w-auto px-6 py-3 rounded-full text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    title="Add Topic"
                    id="add-topic-button"
                >
                    <span class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative z-10 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add Topic
                    </span>
                </button>

                <div class="relative flex-1 w-full sm:w-auto text-left">
                    <button type="button" class="group w-full flex justify-center items-center px-6 py-3 border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700" id="global-add-menu-button" aria-expanded="true" aria-haspopup="true">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add Activity / Resource
                    </button>
                    <div class="origin-top-right absolute right-0 mt-2 w-full sm:w-56 rounded-lg shadow-xl bg-gray-800 ring-1 ring-gray-700 ring-opacity-5 focus:outline-none hidden z-20 transition-all duration-200 ease-in-out transform scale-95 opacity-0" role="menu" aria-orientation="vertical" aria-labelledby="global-add-menu-button" tabindex="-1" id="globalAddMenu">
                        <div class="py-1" role="none">
                            <a href="{{ route('materials.create', $course->id) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                <span class="mr-3 text-lg">📁</span> Material / Resource
                            </a>
                            <a href="{{ route('assessments.create.assignment', ['course'=>$course->id, 'typeAct'=>'activity']) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                <span class="mr-3 text-lg">📝</span> Activity
                            </a>
                            <a href="{{ route('assessments.create.assignment', ['course'=>$course->id, 'typeAct'=>'assignment']) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                <span class="mr-3 text-lg">✍️</span> Assignment
                            </a>
                            <a href="{{ route('assessments.create.quiz', ['course'=>$course->id, 'type'=>'exam']) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                <span class="mr-3 text-lg">📋</span> Exam
                            </a>
                            <a href="{{ route('assessments.create.assignment', ['course'=>$course->id, 'typeAct'=>'project']) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                <span class="mr-3 text-lg">🚀</span> Project
                            </a>
                            <a href="{{ route('assessments.create.quiz', ['course'=>$course->id, 'type'=>'quiz']) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                <span class="mr-3 text-lg">❓</span> Quiz
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{--- Topic section ---}}
            @if($topics->isEmpty())
                <div class="bg-gray-800 bg-opacity-50 p-6 rounded-lg shadow-inner text-center text-gray-500 border border-gray-700 mt-8">
                    <p class="mb-4">No topics have been created yet.</p>
                    <p>Click the <strong class="text-blue-400">Add Topic</strong> button above to structure your course.</p>
                </div>
            @else
                @foreach($topics as $topic)
                    <div class="bg-gray-800 bg-opacity-50 p-6 rounded-lg shadow-xl backdrop-blur-sm topic-section mb-8 border border-gray-700" data-topic-id="{{ $topic->id }}">
                        <div class="flex flex-col sm:flex-row justify-between items-center mb-4 space-y-4 sm:space-y-0">
                            <div class="flex items-center justify-center sm:justify-start gap-2 text-center sm:text-left flex-grow">
                                <button type="button"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-full text-gray-400 hover:text-blue-400 hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 edit-topic-button"
                                    data-topic-id="{{ $topic->id }}"
                                    title="Edit Topic Name"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <input
                                    type="text"
                                    value="{{ $topic->name }}"
                                    class="bg-transparent text-center text-xl sm:text-2xl font-bold text-gray-300 min-w-[100px] w-auto px-2 py-1 disabled:bg-transparent disabled:text-gray-300 focus:bg-gray-700 focus:text-white rounded-md transition-all duration-200 topic-name-input"
                                    disabled
                                    data-topic-id="{{ $topic->id }}"
                                >
                            </div>
                            
                            <div class="relative inline-block text-left w-full sm:w-auto">
                                <button type="button"
                                    class="group w-full flex justify-center items-center px-4 py-2 border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-gray-700 hover:bg-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600 topic-add-menu-button"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                    data-topic-id="{{ $topic->id }}"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Add Item
                                </button>
                                <div class="origin-top-right absolute right-0 mt-2 w-full sm:w-56 rounded-md shadow-lg bg-gray-800 ring-1 ring-gray-700 ring-opacity-5 focus:outline-none hidden z-10 transition-all duration-200 ease-in-out transform scale-95 opacity-0 topic-add-menu"
                                    role="menu"
                                    aria-orientation="vertical"
                                    tabindex="-1"
                                    data-topic-id="{{ $topic->id }}"
                                >
                                    <div class="py-1" role="none">
                                        <a href="{{ route('materials.create', ['course' => $course->id, 'topic_id' => $topic->id]) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                            <span class="mr-3 text-lg">📁</span> Material / Resource
                                        </a>
                                        <a href="{{ route('assessments.create.assignment', ['course'=>$course->id, 'typeAct'=>'activity', 'topic_id'=>$topic->id]) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                            <span class="mr-3 text-lg">📝</span> Activity
                                        </a>
                                        <a href="{{ route('assessments.create.assignment', ['course'=>$course->id, 'typeAct'=>'assignment', 'topic_id'=>$topic->id]) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                            <span class="mr-3 text-lg">✍️</span> Assignment
                                        </a>
                                        <a href="{{ route('assessments.create.quiz', ['course'=>$course->id, 'type'=>'exam', 'topic_id'=>$topic->id]) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                            <span class="mr-3 text-lg">📋</span> Exam
                                        </a>
                                        <a href="{{ route('assessments.create.assignment', ['course'=>$course->id, 'typeAct'=>'project', 'topic_id'=>$topic->id]) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                            <span class="mr-3 text-lg">🚀</span> Project
                                        </a>
                                        <a href="{{ route('assessments.create.quiz', ['course'=>$course->id, 'type'=>'quiz', 'topic_id'=>$topic->id]) }}" class="flex items-center text-gray-300 hover:text-white px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">
                                            <span class="mr-3 text-lg">❓</span> Quiz
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 border-t border-gray-700 pt-4">
                            @php
                                $topicItems = collect($course->materials)
                                    ->where('topic_id', $topic->id)
                                    ->map(function($item) { $item->item_type = 'material'; return $item; })
                                    ->merge(
                                        $course->assessments->where('topic_id', $topic->id)->map(function($item) { $item->item_type = 'assessment'; return $item; })
                                    )
                                    ->sortBy('created_at');
                            @endphp

                            @if ($topicItems->isEmpty())
                                <div class="text-center text-gray-500 py-4">
                                    No content yet. Use the <strong class="text-blue-400">Add Item</strong> button to get started.
                                </div>
                            @else
                                <div class="grid grid-cols-1 gap-4">
                                    @foreach ($topicItems as $item)
                                        <div class="flex justify-between items-start bg-gray-700 bg-opacity-30 p-4 rounded-md border border-gray-600 hover:bg-gray-700 transition-colors duration-200">
                                            <div class="flex flex-col space-y-1 w-full">
                                                <div class="text-md font-medium text-blue-300 flex items-center">
                                                    @if ($item->item_type == 'material')
                                                        <span class="mr-2">📄</span>
                                                        <a href="{{ route('materials.show', $item->id) }}" class="hover:text-white">{{ $item->title }}</a>
                                                    @elseif ($item->item_type == 'assessment')
                                                        <span class="mr-2">
                                                            @if ($item->type == 'quiz' || $item->type == 'exam')
                                                                ❓
                                                            @elseif ($item->type == 'assignment')
                                                                ✍️
                                                            @elseif ($item->type == 'activity')
                                                                📝
                                                            @elseif ($item->type == 'project')
                                                                🚀
                                                            @endif
                                                        </span>
                                                        @if ($item->type == 'quiz' || $item->type == 'exam')
                                                            <a href="{{ route('assessments.show.quiz', ['course' => $course->id, 'assessment' => $item->id]) }}" class="hover:text-white">{{ $item->title }} <span class="text-gray-400">({{ ucfirst($item->type) }})</span></a>
                                                        @else
                                                            <a href="{{ route('assessments.show.assignment', ['course' => $course->id, 'assessment' => $item->id]) }}" class="hover:text-white">{{ $item->title }} <span class="text-gray-400">({{ ucfirst($item->type) }})</span></a>
                                                        @endif
                                                    @endif
                                                </div>
                                                @if($item->description)
                                                    <div class="text-sm text-gray-400 mt-1">
                                                        {{ $item->description }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="relative inline-block text-left ml-4 flex-shrink-0">
                                                <button type="button" class="inline-flex justify-center rounded-md border border-gray-600 shadow-sm px-2 py-1 bg-gray-800 text-sm font-medium text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600 item-action-button" id="menu-button-{{ $item->item_type }}-{{ $item->id }}" aria-expanded="true" aria-haspopup="true">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                    </svg>
                                                </button>

                                                <div class="item-action-menu origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-gray-800 ring-1 ring-gray-700 ring-opacity-5 focus:outline-none hidden z-10" role="menu" aria-orientation="vertical" aria-labelledby="menu-button-{{ $item->item_type }}-{{ $item->id }}" tabindex="-1">
                                                    <div class="py-1" role="none">
                                                        @if ($item->item_type == 'material')
                                                            <a href="{{ route('materials.show', $item->id) }}" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">View</a>
                                                            <a href="{{ route('materials.edit', $item->id) }}" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">Edit</a>
                                                            <form action="{{ route('materials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this material?');" class="block" role="none">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-400 block w-full text-left px-4 py-2 text-sm hover:bg-red-900 hover:text-red-200" role="menuitem" tabindex="-1">Delete</button>
                                                            </form>
                                                        @elseif ($item->item_type == 'assessment')
                                                            @if ($item->type == 'quiz' || $item->type == 'exam')
                                                                <a href="{{ route('assessments.show.quiz', ['course' => $course->id, 'assessment' => $item->id]) }}" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">View</a>
                                                                <a href="{{ route('assessments.edit.quiz', ['course' => $course->id, 'assessment' => $item->id]) }}" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">Edit</a>
                                                            @else
                                                                <a href="{{ route('assessments.show.assignment', ['course' => $course->id, 'assessment' => $item->id]) }}" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">View</a>
                                                                <a href="{{ route('assessments.edit.assignment', ['course' => $course->id, 'assessment' => $item->id]) }}" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700" role="menuitem" tabindex="-1">Edit</a>
                                                            @endif
                                                            <form action="{{ route('assessments.destroy', ['course' => $course->id, 'assessment' => $item->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this assessment?');" class="block" role="none">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-400 block w-full text-left px-4 py-2 text-sm hover:bg-red-900 hover:text-red-200" role="menuitem" tabindex="-1">Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="flex justify-end mt-8">
                <a href="{{ route('instructor.dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-400 hover:text-blue-200 transition-colors duration-200">
                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <div id="add-topic-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50 hidden p-4">
        <div class="bg-gray-800 p-8 rounded-lg shadow-2xl w-full max-w-sm border border-gray-700">
            <h2 class="text-2xl font-bold text-white mb-4">Add New Topic</h2>
            <input type="text" id="new-topic-name" class="bg-gray-700 text-white border border-gray-600 rounded-md w-full px-4 py-2 mb-4 placeholder-gray-400 focus:outline-none focus:border-blue-500" placeholder="e.g., Week 1: Introduction">
            <div class="flex justify-end gap-3">
                <button id="cancel-add-topic" class="px-5 py-2 text-sm font-semibold text-gray-300 rounded-md hover:bg-gray-700 transition-colors duration-200">Cancel</button>
                <button id="submit-add-topic" class="px-5 py-2 text-sm font-semibold text-white rounded-md bg-blue-600 hover:bg-blue-700 transition-colors duration-200">Add Topic</button>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // --- Global "Add Activity/Resource" Dropdown ---
                const globalMenuButton = document.getElementById('global-add-menu-button');
                const globalAddMenu = document.getElementById('globalAddMenu');

                if (globalMenuButton && globalAddMenu) {
                    globalMenuButton.addEventListener('click', function(event) {
                        event.stopPropagation();
                        globalAddMenu.classList.toggle('hidden');
                        globalAddMenu.classList.toggle('scale-95');
                        globalAddMenu.classList.toggle('opacity-0');
                        globalAddMenu.classList.toggle('scale-100');
                        globalAddMenu.classList.toggle('opacity-100');
                    });
                }

                // --- Item Action Dropdowns ---
                document.querySelectorAll('.item-action-button').forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.stopPropagation();
                        const menu = this.closest('.relative').querySelector('.item-action-menu');

                        // Close all other menus first
                        document.querySelectorAll('.item-action-menu').forEach(openMenu => {
                            if (openMenu !== menu) {
                                openMenu.classList.add('hidden');
                            }
                        });

                        menu.classList.toggle('hidden');
                    });
                });

                // --- Edit Topic Button and Input ---
                document.querySelectorAll('.edit-topic-button').forEach(button => {
                    button.addEventListener('click', function(event) {
                        const topicId = this.getAttribute('data-topic-id');
                        const topicNameInput = document.querySelector(`.topic-name-input[data-topic-id="${topicId}"]`);

                        if (topicNameInput) {
                            topicNameInput.disabled = false;
                            topicNameInput.focus();
                            topicNameInput.select();
                        }
                    });
                });

                document.querySelectorAll('.topic-name-input').forEach(input => {
                    input.addEventListener('blur', function(event) {
                        const updatedTopicName = this.value.trim();
                        const topicId = this.getAttribute('data-topic-id');

                        if (updatedTopicName && this.defaultValue !== updatedTopicName) {
                            fetch(`/topics/${topicId}`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ name: updatedTopicName })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Topic updated:', data);
                                this.defaultValue = updatedTopicName;
                            })
                            .catch(error => {
                                console.error('Error updating topic:', error);
                                alert('Error updating topic: ' + error.message);
                                this.value = this.defaultValue;
                            })
                            .finally(() => {
                                this.disabled = true;
                            });
                        } else {
                            this.disabled = true;
                        }
                    });

                    input.addEventListener('keydown', function(event) {
                        if (event.key === 'Enter') {
                            event.preventDefault();
                            this.blur();
                        }
                    });
                });

                // --- Per-topic "Add Activity/Resource" Dropdowns ---
                document.querySelectorAll('.topic-add-menu-button').forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.stopPropagation();
                        const topicId = this.getAttribute('data-topic-id');
                        const menu = document.querySelector(`.topic-add-menu[data-topic-id="${topicId}"]`);

                        document.querySelectorAll('.topic-add-menu').forEach(openMenu => {
                            if (openMenu !== menu) {
                                openMenu.classList.add('hidden');
                                openMenu.classList.remove('scale-100', 'opacity-100');
                                openMenu.classList.add('scale-95', 'opacity-0');
                            }
                        });

                        if (menu) {
                            menu.classList.toggle('hidden');
                            menu.classList.toggle('scale-95');
                            menu.classList.toggle('opacity-0');
                            menu.classList.toggle('scale-100');
                            menu.classList.toggle('opacity-100');
                        }
                    });
                });

                // --- Add Topic Modal Logic ---
                const addTopicButton = document.getElementById('add-topic-button');
                const addTopicModal = document.getElementById('add-topic-modal');
                const cancelAddTopic = document.getElementById('cancel-add-topic');
                const submitAddTopic = document.getElementById('submit-add-topic');
                const newTopicName = document.getElementById('new-topic-name');
                const courseId = {{ $course->id }};

                if (addTopicButton && addTopicModal) {
                    addTopicButton.addEventListener('click', function() {
                        addTopicModal.classList.remove('hidden');
                        newTopicName.value = '';
                        newTopicName.focus();
                    });
                }
                if (cancelAddTopic) {
                    cancelAddTopic.addEventListener('click', function() {
                        addTopicModal.classList.add('hidden');
                    });
                }
                if (submitAddTopic) {
                    submitAddTopic.addEventListener('click', function() {
                        const name = newTopicName.value.trim();
                        if (!name) {
                            alert('Please enter a topic name.');
                            return;
                        }
                        fetch('{{ route('topics.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ name: name, course_id: courseId })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Topic created:', data);
                            addTopicModal.classList.add('hidden');
                            window.location.reload(); // Reload to show the new topic
                        })
                        .catch(error => {
                            console.error('Error creating topic:', error);
                            alert('Error creating topic: ' + error.message);
                        });
                    });
                }

                // Close dropdowns when clicking outside
                document.addEventListener('click', function(event) {
                    if (globalAddMenu && !globalAddMenu.contains(event.target) && !globalMenuButton.contains(event.target)) {
                        globalAddMenu.classList.add('hidden');
                        globalAddMenu.classList.remove('scale-100', 'opacity-100');
                        globalAddMenu.classList.add('scale-95', 'opacity-0');
                    }
                    document.querySelectorAll('.topic-add-menu').forEach(menu => {
                        const button = document.querySelector(`.topic-add-menu-button[data-topic-id="${menu.getAttribute('data-topic-id')}"]`);
                        if (!menu.contains(event.target) && !button.contains(event.target)) {
                            menu.classList.add('hidden');
                            menu.classList.remove('scale-100', 'opacity-100');
                            menu.classList.add('scale-95', 'opacity-0');
                        }
                    });
                    document.querySelectorAll('.item-action-menu').forEach(menu => {
                        const button = menu.closest('.relative').querySelector('.item-action-button');
                        if (!menu.contains(event.target) && !button.contains(event.target)) {
                            menu.classList.add('hidden');
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-layout>