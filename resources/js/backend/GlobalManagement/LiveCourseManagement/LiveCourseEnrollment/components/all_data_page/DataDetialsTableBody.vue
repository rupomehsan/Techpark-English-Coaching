<template>
  <!-- {{ item }} -->

  <template v-for="(row_item, index) in filteredFields" :key="index">
    <tr>
      <th>{{ row_item }}</th>
      <th class="text-center">:</th>
      <th class="text-trim">
        <template v-if="row_item === 'image'">
          <a 
            :href="item[row_item] || '/avatar.png'" 
            data-fancybox="detail-gallery" 
            :data-caption="`${row_item} - Detail View`"
          >
            <img
              :src="item[row_item] || '/avatar.png'"
              @error="handleImageError($event)"
              style="width: 120px; height: 120px; object-fit: cover"
              alt="image"
            />
          </a>
        </template>
        <template v-else-if="is_html(item[row_item])">
          <span v-html="item[row_item]"></span>
        </template>
        <template v-else-if="is_complex(item[row_item])">
          <table class="table table-sm table-bordered mb-0" style="font-size:12px">
            <tbody>
              <tr v-for="(val, key) in flatten(item[row_item])" :key="key">
                <td style="width:40%;font-weight:600">{{ key }}</td>
                <td>{{ val }}</td>
              </tr>
            </tbody>
          </table>
        </template>
        <template v-else>
          {{ trim_content(item[row_item], row_item) }}
        </template>
      </th>
    </tr>
  </template>
</template>

<script>
import setup from "../../setup";
import SelectAll from "./select_data/SelectAll.vue";
import TableRowAction from "./TableRowAction.vue";
import SelectSingle from "./select_data/SelectSingle.vue";
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

export default {
  props: ["item"],
  data: () => ({
    setup,
  }),
  components: {
    SelectAll,
    TableRowAction,
    SelectSingle,
  },

  mounted() {
    this.initFancybox();
  },

  updated() {
    this.initFancybox();
  },

  beforeUnmount() {
    // Cleanup Fancybox instances
    Fancybox.destroy();
  },

  computed: {
    filteredFields() {
      return setup.select_fields.filter(field => field !== 'deleted_at');
    }
  },

  methods: {
    handleImageError(event) {
      // When image fails to load, set src to avatar.png
      event.target.src = '/avatar.png';
      // Also update the parent link href to avatar.png
      const parentLink = event.target.closest('a');
      if (parentLink) {
        parentLink.href = '/avatar.png';
      }
    },

    initFancybox() {
      // Initialize Fancybox for detail images
      Fancybox.bind('[data-fancybox="detail-gallery"]', {
        // Fancybox options for detail view
        Toolbar: {
          display: {
            left: ["infobar"],
            middle: [
              "zoomIn",
              "zoomOut",
              "toggle1to1",
              "rotateCCW",
              "rotateCW",
              "flipX",
              "flipY",
            ],
            right: ["download", "close"],
          },
        },
        Thumbs: {
          autoStart: false,
        },
        // Better for single image detail view
        wheel: "zoom",
        touch: {
          vertical: true,
          momentum: true,
        },
      });
    },

    is_html(content) {
      return typeof content === 'string' && /<[a-z][\s\S]*>/i.test(content);
    },

    is_complex(content) {
      if (content === null || content === undefined) return false;
      if (Array.isArray(content)) return true;
      if (typeof content !== 'object') return false;
      // Relationship objects with simple label → handled by trim_content
      if (content.batch_number !== undefined) return false;
      if (content.name !== undefined || content.title !== undefined) return false;
      return true;
    },

    flatten(content, prefix = '') {
      if (Array.isArray(content)) {
        return content.reduce((acc, val, i) => {
          if (val && typeof val === 'object') {
            Object.assign(acc, this.flatten(val, `[${i}] `));
          } else {
            acc[`${prefix}${i}`] = val;
          }
          return acc;
        }, {});
      }
      return Object.entries(content).reduce((acc, [k, v]) => {
        const key = prefix ? `${prefix}${k}` : k;
        if (v && typeof v === 'object' && !Array.isArray(v)) {
          Object.assign(acc, this.flatten(v, `${key}.`));
        } else if (Array.isArray(v)) {
          acc[key] = v.join(', ');
        } else {
          acc[key] = v;
        }
        return acc;
      }, {});
    },

    trim_content(content, row_item = null) {
      if (typeof content == "string") {
        if (row_item == "created_at" || row_item == "updated_at") {
          return new Intl.DateTimeFormat("en-US", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
          }).format(new Date(content));
        }
        return content.length > 50 ? content.substring(0, 50) + "..." : content;
      }
      if (content && typeof content === "object") {
        if (content.batch_number !== undefined) {
          return `${content.batch_number} - ${content.shift_name}`;
        }
        for (const key of Object.keys(content)) {
          if (key === "title" && content.title) {
            return content.title;
          }
          if (key === "name" && content.name) {
            return content.name;
          }
        }
      }

      return content || "";
    },
  },
};
</script>

<style scoped>
.max-w-120 {
  max-width: 120px;
}
</style>
