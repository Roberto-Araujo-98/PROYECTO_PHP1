global _start

section .data
    msg db 'Hola Mundo desde ASM!', 0xa
    len equ $ - msg

section .text
_start:
    mov edx, len
    mov ecx, msg
    mov ebx, 1
    mov eax, 4
    int 0x80

    mov eax, 1
    mov ebx, 0
    int 0x80
