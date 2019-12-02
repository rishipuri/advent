(import (chicken io))
(import (chicken string))

(define file->list
  (lambda (filename)
    (call-with-input-file filename
      (lambda (port)
        (read-lines port)))))

(define list-replace
  (lambda (l i r)
    (cond
      ((null? l) '())
      ((zero? i) (cons r (cdr l)))
      (else (cons (car l) (list-replace (cdr l) (- i 1) r))))))

(define lstr->lnum
  (lambda (l)
    (cond
      ((null? l) '())
      ((number? (car l)) (cons (car l) (lstr->lnum (cdr l))))
      (else (cons (string->number (car l)) (lstr->lnum (cdr l)))))))

(define fetch-input
  (lambda (filename)
    (lstr->lnum (string-split (car (file->list filename)) ","))))

(define opcode-1
  (lambda (l i)
    (list-replace
      l
      (list-ref l (+ i 3))
      (+ (list-ref l (list-ref l (+ i 1))) (list-ref l (list-ref l (+ i 2)))))))

(define opcode-2
  (lambda (l i)
    (list-replace
      l
      (list-ref l (+ i 3))
      (* (list-ref l (list-ref l (+ i 1))) (list-ref l (list-ref l (+ i 2)))))))

(define run-intcode
  (lambda (codes i)
    (cond
      ((= 99 (list-ref codes i)) (list-ref codes 0))
      ((= 1 (list-ref codes i)) (run-intcode (opcode-1 codes i) (+ i 4)))
      ((= 2 (list-ref codes i)) (run-intcode (opcode-2 codes i) (+ i 4))))))

(define run
  (lambda (codes noun verb)
    (run-intcode (list-replace (list-replace codes 1 noun) 2 verb) 0)))

(run (fetch-input "input.txt") 12 2) ; 2890696
