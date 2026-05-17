<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="text-capitalize mb-0">
                        {{ param_id ? `${setup.edit_page_title}` : `${setup.create_page_title}` }}
                    </h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm" :to="{
                            name: `Details${setup.route_prefix}`,
                            params: { id: item.slug },
                        }">
                            {{ setup.details_page_title }}
                        </router-link>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${setup.route_prefix}` }">
                            {{ setup.all_page_title }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">

                        <template v-for="(form_field, index) in form_fields" v-bind:key="index">
                            <common-input :label="form_field.label" :type="form_field.type" :name="form_field.name"
                                :multiple="form_field.multiple" :value="form_field.value"
                                :data_list="form_field.data_list" :is_visible="form_field.is_visible"
                                :row_col_class="form_field.row_col_class" />
                        </template>

                        <!-- Quiz Questions Section -->
                        <div class="col-12 mt-4">
                            <div class="quiz-questions-panel">
                                <!-- Panel Header -->
                                <div class="qp-header">
                                    <div class="qp-title">
                                        <i class="fas fa-question-circle mr-2"></i>
                                        Quiz Questions
                                    </div>
                                    <div class="qp-badges">
                                        <span class="qp-badge qp-badge-total">
                                            <i class="fas fa-list mr-1"></i>
                                            {{ displayedQuestions.length }} shown
                                        </span>
                                        <span class="qp-badge qp-badge-selected" v-if="selectedQuestions.length > 0">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            {{ selectedQuestions.length }} selected
                                        </span>
                                    </div>
                                </div>

                                <!-- Filters Row -->
                                <div class="qp-filters">
                                    <div class="qp-filter-group">
                                        <label class="qp-filter-label">
                                            <i class="fas fa-tag mr-1"></i>Filter by Topic
                                        </label>
                                        <select v-model="selectedTopic" @change="onTopicChange" class="qp-select">
                                            <option value="">All Topics</option>
                                            <option v-for="topic in topics" :key="topic.id" :value="topic.id">
                                                {{ topic.title }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="qp-filter-group qp-filter-search">
                                        <label class="qp-filter-label">
                                            <i class="fas fa-search mr-1"></i>Search Question
                                        </label>
                                        <div class="qp-search-wrap">
                                            <input
                                                type="text"
                                                v-model="questionSearch"
                                                class="qp-search-input"
                                                placeholder="Type to search questions..."
                                            />
                                            <button
                                                v-if="questionSearch"
                                                type="button"
                                                class="qp-search-clear"
                                                @click="questionSearch = ''"
                                            >
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="qp-filter-actions">
                                        <button type="button" class="qp-btn qp-btn-primary" @click="selectAllVisible">
                                            <i class="fas fa-check-double mr-1"></i>Select All
                                        </button>
                                        <button type="button" class="qp-btn qp-btn-secondary" @click="deselectAllQuestions">
                                            <i class="fas fa-times mr-1"></i>Clear
                                        </button>
                                    </div>
                                </div>

                                <!-- Questions List -->
                                <div class="qp-list-wrap">
                                    <div v-if="displayedQuestions.length === 0" class="qp-empty">
                                        <i class="fas fa-search fa-2x mb-2"></i>
                                        <p>No questions match your filters</p>
                                    </div>
                                    <div class="qp-grid">
                                        <div
                                            v-for="question in displayedQuestions"
                                            :key="question.id"
                                            class="qp-item"
                                            :class="{ 'qp-item-selected': selectedQuestions.includes(question.id) }"
                                            @click="toggleQuestion(question.id)"
                                        >
                                            <div class="qp-item-check">
                                                <input
                                                    type="checkbox"
                                                    :value="question.id"
                                                    v-model="selectedQuestions"
                                                    :id="'question-' + question.id"
                                                    @click.stop
                                                />
                                            </div>
                                            <div class="qp-item-body">
                                                <div class="qp-item-title">{{ question.title }}</div>
                                                <div class="qp-item-meta">
                                                    <span class="qp-meta-chip qp-chip-topic">
                                                        <i class="fas fa-tag mr-1"></i>
                                                        {{ question.quiz_question_topic_id ? question.quiz_question_topic_id.title : 'N/A' }}
                                                    </span>
                                                    <span class="qp-meta-chip qp-chip-level">
                                                        <i class="fas fa-signal mr-1"></i>
                                                        {{ question.question_level || 'N/A' }}
                                                    </span>
                                                    <span class="qp-meta-chip qp-chip-mark">
                                                        <i class="fas fa-star mr-1"></i>
                                                        {{ question.mark || 0 }} mark
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="qp-item-indicator" v-if="selectedQuestions.includes(question.id)">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-light btn-square px-5">
                        <i class="icon-lock"></i>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { store } from "../store";
import setup from "../setup";
import form_fields from "../setup/form_fields";

export default {
    components: {},
    data: () => ({
        setup,
        form_fields,
        param_id: null,
        topics: [],
        selectedTopic: '',
        filteredQuestions: [],
        selectedQuestions: [],
        questionSearch: '',
    }),
    created: async function () {
        let id = (this.param_id = this.$route.params.id);
        this.reset_fields();
        await this.fetchTopics();
        // fetchQuestions is now called inside fetchTopics via extractQuestionsFromTopics
        if (id) {
            this.set_fields(id);
        }
    },
    mounted() {
        // Prevent non-numeric input for negative_value
        this.$nextTick(() => {
            const input = document.querySelector('input[name="negative_value"]');
            if (input) {
                input.addEventListener('input', function(e) {
                    // Remove any non-digit characters (allow negative sign and decimal)
                    let val = input.value;
                    val = val.replace(/[^0-9.-]/g, '');
                    // Only allow one negative sign at the start
                    val = val.replace(/(?!^)-/g, '');
                    // Only allow one decimal point
                    val = val.replace(/(\..*)\./g, '$1');
                    input.value = val;
                });
            }
        });
    },
    methods: {
        ...mapActions(store, {
            create: "create",
            update: "update",
            details: "details",
            get_all: "get_all",
            set_only_latest_data: "set_only_latest_data",
        }),
        async fetchTopics() {
            // Fetch topics from API
            const res = await fetch('api/v1/quiz-question-topics');
            if (res.ok) {
                const result = await res.json();
                this.topics = result.data.data;
                // Extract all questions from all topics
                this.extractQuestionsFromTopics();
            }
        },
        extractQuestionsFromTopics() {
            // Extract all questions from topics and create filteredQuestions structure
            let allQuestions = [];
            this.topics.forEach(topic => {
                if (topic.quiz_question && Array.isArray(topic.quiz_question)) {
                    topic.quiz_question.forEach(question => {
                        // Add topic info to question for display
                        question.quiz_question_topic_id = {
                            id: topic.id,
                            title: topic.title
                        };
                        allQuestions.push(question);
                    });
                }
            });

            // Create pagination-like structure to match existing code
            this.filteredQuestions = {
                data: allQuestions,
                total: allQuestions.length
            };
        },
        async fetchQuestions() {
            // Filter questions based on selected topic
            let filteredQuestions = [];

            if (!this.selectedTopic) {
                // Show all questions
                this.topics.forEach(topic => {
                    if (topic.quiz_question && Array.isArray(topic.quiz_question)) {
                        topic.quiz_question.forEach(question => {
                            question.quiz_question_topic_id = {
                                id: topic.id,
                                title: topic.title
                            };
                            filteredQuestions.push(question);
                        });
                    }
                });
            } else {
                // Filter questions by selected topic, but also include selected questions from other topics
                const selectedTopicData = this.topics.find(t => t.id == this.selectedTopic);
                if (selectedTopicData && selectedTopicData.quiz_question) {
                    selectedTopicData.quiz_question.forEach(question => {
                        question.quiz_question_topic_id = {
                            id: selectedTopicData.id,
                            title: selectedTopicData.title
                        };
                        filteredQuestions.push(question);
                    });
                }

                // Add selected questions from other topics to maintain visibility
                this.topics.forEach(topic => {
                    if (topic.id != this.selectedTopic && topic.quiz_question && Array.isArray(topic.quiz_question)) {
                        topic.quiz_question.forEach(question => {
                            if (this.selectedQuestions.includes(question.id)) {
                                question.quiz_question_topic_id = {
                                    id: topic.id,
                                    title: topic.title
                                };
                                filteredQuestions.push(question);
                            }
                        });
                    }
                });
            }

            this.filteredQuestions = {
                data: filteredQuestions,
                total: filteredQuestions.length
            };
        },
        onTopicChange() {
            this.fetchQuestions();
        },
        toggleQuestion(id) {
            const idx = this.selectedQuestions.indexOf(id);
            if (idx === -1) {
                this.selectedQuestions.push(id);
            } else {
                this.selectedQuestions.splice(idx, 1);
            }
        },
        selectAllVisible() {
            const visibleIds = this.displayedQuestions.map(q => q.id);
            const merged = [...new Set([...this.selectedQuestions, ...visibleIds])];
            this.selectedQuestions = merged;
        },
        deselectAllQuestions() {
            this.selectedQuestions = [];
        },
        reset_fields: function () {
            this.form_fields.forEach((item) => {
                item.value = "";
            });
        },
        set_fields: async function (id) {
            this.param_id = id;
            await this.details(id);
            if (this.item) {
                this.form_fields.forEach((field, index) => {
                    Object.entries(this.item).forEach((value) => {
                        if (field.name == value[0]) {
                            this.form_fields[index].value = value[1];
                        }
                        // If the field is a textarea, set its summernote content dynamically
                        if (field.type === "textarea" && field.name === value[0]) {
                            $(`#${field.name}`).summernote("code", value[1]);
                        }
                    });
                });
                // Set selected questions for edit
                if (this.item.quiz_questions && Array.isArray(this.item.quiz_questions)) {
                    this.selectedQuestions = this.item.quiz_questions.map(q => q.id);
                }
            }
        },
        submitHandler: async function ($event) {
            this.set_only_latest_data(true);
            this.setSummerEditor();

            // Add hidden inputs for quiz questions to the form
            const form = $event.target;

            // Remove any existing quiz_questions[] inputs
            const existingInputs = form.querySelectorAll('input[name="quiz_questions[]"]');
            existingInputs.forEach(input => input.remove());

            // Add selected quiz questions as hidden inputs
            this.selectedQuestions.forEach(qid => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'quiz_questions[]';
                hiddenInput.value = qid;
                form.appendChild(hiddenInput);
            });

            let response;
            if (this.param_id) {
                response = await this.update($event);
                if ([200, 201].includes(response.status)) {
                    window.s_alert("Data successfully updated");
                    this.$router.push({ name: `Details${this.setup.route_prefix}` });
                }
            } else {
                response = await this.create($event);
                if ([200, 201].includes(response.status)) {
                    $event.target.reset();
                    this.form_fields.forEach(field => {
                        if (field.type === 'textarea' && $(`#${field.name}`).length) {
                            $(`#${field.name}`).summernote("code", '');
                        }
                    });
                    this.selectedQuestions = []; // Clear selected questions
                    window.s_alert("Data Successfully Created");
                }
            }
        },
        setSummerEditor() {
            // Dynamically set summernote content for all textarea fields
            this.form_fields.forEach(field => {
                if (field.type === 'textarea' && $(`#${field.name}`).length) {
                    const markupStr = $(`#${field.name}`).summernote("code");
                    // Set the value in the form field object
                    field.value = markupStr;
                    // Optionally, update a hidden input if your backend expects it
                    let $input = $(`#${field.name}_hidden`);
                    if ($input.length === 0) {
                        $input = $(`<input type="hidden" id="${field.name}_hidden" name="${field.name}">`);
                        $(`#${field.name}`).parent().append($input);
                    }
                    $input.val(markupStr);
                }
            });
        },
    },
    computed: {
        ...mapState(store, {
            item: "item",
        }),
        displayedQuestions() {
            let list = this.filteredQuestions.data || [];
            if (this.questionSearch.trim()) {
                const q = this.questionSearch.trim().toLowerCase();
                list = list.filter(question =>
                    question.title && question.title.toLowerCase().includes(q)
                );
            }
            return list;
        },
    },
};
</script>

<style scoped>
.quiz-questions-panel {
    border: 1px solid #2d3748;
    border-radius: 10px;
    overflow: hidden;
}

/* Header */
.qp-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 18px;
    background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
    border-bottom: 1px solid #4a5568;
}
.qp-title {
    font-size: 1rem;
    font-weight: 700;
    color: #e2e8f0;
    letter-spacing: 0.3px;
}
.qp-title i { color: #63b3ed; }
.qp-badges { display: flex; gap: 8px; }
.qp-badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}
.qp-badge-total { background: #2c5282; color: #bee3f8; }
.qp-badge-selected { background: #276749; color: #c6f6d5; }

/* Filters */
.qp-filters {
    display: flex;
    gap: 12px;
    align-items: flex-end;
    padding: 14px 18px;
    background: #1a202c;
    border-bottom: 1px solid #2d3748;
    flex-wrap: wrap;
}
.qp-filter-group { display: flex; flex-direction: column; gap: 5px; min-width: 180px; }
.qp-filter-search { flex: 1; }
.qp-filter-label {
    font-size: 0.72rem;
    font-weight: 600;
    color: #a0aec0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.qp-select {
    background: #2d3748;
    border: 1px solid #4a5568;
    border-radius: 6px;
    color: #e2e8f0;
    padding: 7px 10px;
    font-size: 0.85rem;
    outline: none;
    transition: border-color 0.2s;
}
.qp-select:focus { border-color: #63b3ed; }
.qp-search-wrap { position: relative; }
.qp-search-input {
    width: 100%;
    background: #2d3748;
    border: 1px solid #4a5568;
    border-radius: 6px;
    color: #e2e8f0;
    padding: 7px 32px 7px 10px;
    font-size: 0.85rem;
    outline: none;
    transition: border-color 0.2s;
}
.qp-search-input::placeholder { color: #718096; }
.qp-search-input:focus { border-color: #63b3ed; }
.qp-search-clear {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #718096;
    cursor: pointer;
    padding: 0;
    font-size: 0.8rem;
}
.qp-search-clear:hover { color: #e2e8f0; }
.qp-filter-actions { display: flex; gap: 8px; align-items: flex-end; }
.qp-btn {
    display: inline-flex;
    align-items: center;
    padding: 7px 14px;
    border-radius: 6px;
    border: none;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}
.qp-btn-primary { background: #2b6cb0; color: #bee3f8; }
.qp-btn-primary:hover { background: #2c5282; }
.qp-btn-secondary { background: #4a5568; color: #e2e8f0; }
.qp-btn-secondary:hover { background: #2d3748; }

/* List */
.qp-list-wrap {
    max-height: 380px;
    overflow-y: auto;
    background: #171923;
    padding: 8px;
}
.qp-list-wrap::-webkit-scrollbar { width: 6px; }
.qp-list-wrap::-webkit-scrollbar-track { background: #1a202c; }
.qp-list-wrap::-webkit-scrollbar-thumb { background: #4a5568; border-radius: 3px; }

.qp-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6px;
}

.qp-empty {
    text-align: center;
    padding: 40px 20px;
    color: #4a5568;
}
.qp-empty p { margin: 0; font-size: 0.9rem; }

.qp-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    border-radius: 7px;
    border: 1px solid transparent;
    cursor: pointer;
    transition: all 0.15s;
    margin-bottom: 4px;
}
.qp-item:hover { background: #2d3748; border-color: #4a5568; }
.qp-item-selected { background: #1a365d !important; border-color: #2b6cb0 !important; }

.qp-item-check { flex-shrink: 0; }
.qp-item-check input[type="checkbox"] {
    width: 16px;
    height: 16px;
    cursor: pointer;
    accent-color: #63b3ed;
}

.qp-item-body { flex: 1; min-width: 0; }
.qp-item-title {
    font-size: 0.88rem;
    font-weight: 600;
    color: #e2e8f0;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.qp-item-meta { display: flex; flex-wrap: wrap; gap: 6px; }
.qp-meta-chip {
    display: inline-flex;
    align-items: center;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 500;
}
.qp-chip-topic { background: #2c5282; color: #90cdf4; }
.qp-chip-level { background: #44337a; color: #d6bcfa; }
.qp-chip-mark  { background: #744210; color: #fbd38d; }

.qp-item-indicator { color: #48bb78; font-size: 1rem; flex-shrink: 0; }

@media (max-width: 768px) {
    .qp-filters { flex-direction: column; }
    .qp-filter-group { min-width: 100%; }
    .qp-grid { grid-template-columns: 1fr; }
}
</style>
