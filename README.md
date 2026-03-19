# 🚀 SERVIJAM: Gestión de Impresión 3D en Red

<p align="center">
  <img src="https://capsule-render.vercel.app/render?type=waving&color=003366&height=200&section=header&text=SERVIJAM&fontSize=80&animation=fadeIn" />
</p>

## 📝 Resumen del Proyecto
**Servijam** es un sistema de gestión para impresoras 3D en red diseñado para entornos colaborativos (centros educativos, laboratorios o espacios maker). [cite_start]Utiliza una arquitectura modular sobre **Raspberry Pi** para permitir el control remoto, seguro y eficiente de los procesos de fabricación aditiva[cite: 971, 972].

---

## 📂 Estructura del Repositorio

| Carpeta | Contenido |
| :--- | :--- |
| [📁 Web Interactive](./creacion-de-web-interactiva) | [cite_start]Código fuente de la plataforma (Login, Panel de Usuario/Admin)[cite: 989]. |
| [📁 Infrastructure](./esquema-de-red) | [cite_start]Configuración de red, VPN (Tailscale) y Docker[cite: 985]. |
| [📁 Database](./base-de-datos) | [cite_start]Modelos relacionales e implementación en MariaDB[cite: 990]. |
| [📁 Documentation](./docs) | [cite_start]Memoria técnica completa y bibliografía[cite: 994]. |

---

## 🛠️ Stack Tecnológico

### **Infraestructura y Red**
* [cite_start]**Controlador:** Raspberry Pi 4 con Raspbian[cite: 1018, 1020].
* [cite_start]**VPN:** [Tailscale](https://tailscale.com/) (Protocolo WireGuard) para conectividad punto a punto segura[cite: 1038, 1040].
* [cite_start]**DNS Dinámico:** Duck DNS para acceso remoto con IP dinámica[cite: 1165].
* [cite_start]**Proxy:** Nginx Proxy Manager para gestión de certificados SSL y tráfico[cite: 1186].

### **Ecosistema 3D**
* [cite_start]**Firmware:** Klipper (Control de bajo nivel)[cite: 1021].
* [cite_start]**API:** Moonraker (Intermediario REST API / WebSocket)[cite: 1067, 1082].
* [cite_start]**Interfaz G-Code:** Fluidd (Ligera y responsiva)[cite: 1086].
* [cite_start]**Laminador:** Kiri:Moto (Slicing en la nube/web)[cite: 1519].

### **Desarrollo Web**
* [cite_start]**Backend:** PHP (PDO) con MariaDB[cite: 1299, 1803].
* [cite_start]**Contenedores:** Docker & Docker Compose[cite: 1126, 1147].
* [cite_start]**Servidor Web:** Apache HTTP Server[cite: 1104].

---

## ⚙️ Características Principales

* [cite_start]**🔐 Seguridad:** Autenticación de usuarios con hash de contraseñas y restricción por roles (Admin/User)[cite: 1003, 1257].
* [cite_start]**📊 Monitorización:** Consulta en tiempo real de temperaturas (extruder/bed) y progreso de impresión mediante la API de Moonraker[cite: 1011, 1074].
* [cite_start]**📂 Gestión de Archivos:** Carga y validación de archivos `.gcode` con almacenamiento jerárquico por usuario[cite: 1005, 1027].
* [cite_start]**🕒 Cola de Impresión:** Gestión de trabajos bajo política **FIFO** (First In, First Out)[cite: 1007].
* [cite_start]**👁️ Visor 3D:** Integración de *GCode Analyzer* para vista previa del modelo antes de imprimir[cite: 1535].

---

## 📐 Esquema de Red
[cite_start]El sistema se integra de forma transparente en redes existentes mediante una IP estática y el nodo de gestión **RASPI-1**[cite: 1033, 1203]:

1. **R1:** Router doméstico.
2. **RASPI-1:** Gestor de servicios internos/externos.
3. **RASPI-2:** Controlador directo de la impresora (Klipper).
4. [cite_start]**IMP-3D-1:** Impresora FDM[cite: 1031, 1035].

---

## 👥 Autores
Proyecto realizado por:
* [cite_start]**Juan Carlos Hernández Risso** [cite: 953]
* [cite_start]**Arturo Manso Borrego** [cite: 953]
* [cite_start]**Marco Antonio Méndez Rivero** [cite: 953]

[cite_start]**Tutor:** Alberto Fernández Sánchez [cite: 952]  
[cite_start]**Institución:** La Salle [cite: 956]  
[cite_start]**Año:** 2025 [cite: 954]

---

## 📜 Licencia
[cite_start]Este proyecto está bajo la licencia **Creative Commons Reconocimiento-NoComercial 4.0 Internacional (CC BY-NC 4.0)**[cite: 969].
