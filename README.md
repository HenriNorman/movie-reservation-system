# 🎬 Movie Reservation API

A RESTful backend API for a movie reservation system, built with **Laravel**.  
It models the full cinema experience — cinemas, halls, seats, movies, showtimes, and reservations — with role-based access control and JWT authentication.

> ⚠️ **Project status:** Active development. Not yet deployed. See [Roadmap](#-roadmap) for planned features.

---

## 📖 Overview

This API powers a movie ticket reservation platform. It supports the full user journey of browsing cinemas → viewing movies → selecting showtimes → reserving seats, backed by a normalized relational schema and role-aware access.

The architecture follows REST principles, with clean separation of concerns, validated inputs, and JWT-based stateless authentication.

---

## ✨ Features

### ✅ Implemented

- **Full user flow** — browse cinemas, movies, showtimes, and reserve seats
- **Rich domain modeling:**
  - `Cinema` — physical location
  - `Hall` — belongs to a cinema, can be **VIP**
  - `Seat` — belongs to a hall, can individually be **VIP**
  - `Movie`, `Showtime`, `Reservation`
- **Authentication** — JWT-based
- **Role-Based Access Control (RBAC)** — `user` and `admin` roles via **Spatie Laravel-Permission**
- **Request validation** on all endpoints
- **Well-designed relational database schema** (see [Database Schema](#-database-schema))
- **RESTful architecture** — resource-oriented routes, standard HTTP verbs and status codes

### 🚧 Planned / In Progress

- [ ] **Security headers** (CSP, HSTS, X-Frame-Options, etc.)
- [ ] **Admin dashboard** — manage cinemas, halls, seats, movies, showtimes
- [ ] **Payment integration**
- [ ] **Stronger reservation logic** — seat locking, race-condition handling, expiration
- [ ] **Performance & load testing**
- [ ] **Automated test suite**

---

## 🏗️ Architecture

The app follows **MVC with a service layer**. Controllers handle HTTP concerns only; business logic lives in dedicated service classes.

Domain rules are encapsulated in services — e.g. `CinemaService` and `HallService` handle hall layout validation, VIP hall/seat constraints, and safe deletion of halls with active reservations. Controllers stay thin and delegate to these services.

Example flow for a request:
Request → Controller (validate) → Service (business logic) → Models → Response

---

## 🧱 Tech Stack

| Layer | Technology |
|-------|------------|
| Framework | Laravel |
| Language | PHP |
| Auth | JWT |
| Authorization | Spatie Laravel-Permission |
| Database | MySQL / PostgreSQL |
| Architecture | REST, MVC + service layer |

---

## 🗄️ Database Schema

The schema is fully normalized and models the cinema hierarchy with per-entity VIP flags.


<img width="2852" height="1630" alt="Untitled" src="https://github.com/user-attachments/assets/35d62d46-e049-4f34-8d2e-ea49f672920b" />


---

## 🚀 Getting Started

### Requirements

- PHP 8.1+
- Composer
- MySQL or PostgreSQL
