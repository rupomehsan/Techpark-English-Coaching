# Database Schema — Believers' English Academy

> live course management system

---

## Tables

---

### `live_courses`

| Column               | Type                                               | Notes                           |
| -------------------- | -------------------------------------------------- | ------------------------------- |
| id                   | BIGINT PK AI                                       |                                 |
| live_course_type     | BIGINT FK → residential,non-residential,online     |                                 |
| course_features      | BIGINT FK → residential,non-residential,online     |                                 |
| course_specification | BIGINT FK → residential,non-residential,online     |                                 |
| course_duration      | BIGINT FK → residential,non-residential,online     |                                 |
| title                | VARCHAR(255)                                       | English title                   |
| description          | LONGTEXT                                           | Full course description         |
| thumbnail            | VARCHAR(500)                                       | Image path                      |
| promo_video_url      | VARCHAR(500)                                       | YouTube marketing video URL     |
| total_seats          | INT                                                | e.g. 32                         |
| regular_price        | DECIMAL(10,2)                                      | e.g. 35000.00                   |
| sale_price           | DECIMAL(10,2)                                      | e.g. 25000.00                   |
| discount_percent     | DECIMAL(5,2)                                       | e.g. 29.00 (computed or stored) |
| installment_months   | INT NULLABLE                                       | e.g. 2                          |
| is_popular           | TINYINT(1) DEFAULT 0                               | Show in footer popular list     |
| status               | ENUM('active','inactive','draft') DEFAULT 'active' |                                 |
| sort_order           | INT DEFAULT 0                                      |                                 |
| created_at           | TIMESTAMP                                          |                                 |
| updated_at           | TIMESTAMP                                          |                                 |

---

### `live_course_batches`

| Column            | Type                                                                  | Notes                          |
| ----------------- | --------------------------------------------------------------------- | ------------------------------ |
| id                | BIGINT PK AI                                                          |                                |
| live_course_id    | BIGINT FK → live_courses.id                                           |                                |
| batch_number      | INT                                                                   | e.g. 109, 99                   |
| shift_name        | VARCHAR(100)                                                          | e.g. Morning Shift, Day Shift  |
| course_start_date | DATE                                                                  | e.g. 2026-02-03                |
| course_end_date   | DATE                                                                  | e.g. 2026-02-03                |
| class_start_time  | TIME                                                                  | e.g. 08:00:00                  |
| class_end_time    | TIME                                                                  | e.g. 14:00:00                  |
| class_days        | SET('Sat','Sun','Mon','Tue','Wed','Thu','Fri')                        | e.g. 'Sat,Sun,Mon,Tue,Wed,Thu' |
| seats_remaining   | INT                                                                   |                                |
| enrolled_count    | INT DEFAULT 0                                                         |                                |
| status            | ENUM('upcoming','running','completed','cancelled') DEFAULT 'upcoming' |                                |
| created_at        | TIMESTAMP                                                             |                                |
| updated_at        | TIMESTAMP                                                             |                                |

> `seats_remaining` = `total_seats - enrolled_count` (computed, not stored)

---

### `live_course_enrollments`

| Column          | Type                                                          | Notes                  |
| --------------- | ------------------------------------------------------------- | ---------------------- |
| id              | BIGINT PK AI                                                  |                        |
| student_id      | BIGINT FK → live_course_students.id                           |                        |
| batch_id        | BIGINT FK → live_course_batches.id                            |                        |
| live_course_id  | BIGINT FK → live_courses.id                                   |                        |
| student_info    | json                                                          |                        |
| enrolled_at     | TIMESTAMP                                                     |                        |
| payment_status  | ENUM('pending','partial','paid','refunded') DEFAULT 'pending' |                        |
| amount_paid     | DECIMAL(10,2) DEFAULT 0                                       |                        |
| transaction_id  | VARCHAR(255) NULLABLE                                         |                        |
| amount          | DECIMAL(10,2)                                                 |                        |
| payemnt_details | DECIMAL(10,2)                                                 |                        |
| method          | VARCHAR(100)                                                  | e.g. bKash, Card, Cash |

> UNIQUE constraint on `(student_id, batch_id)`

---
