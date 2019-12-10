(load "A.scm")

(require-extension srfi-69)

(define get-repeat-count
  (lambda (x)
    (define d (make-hash-table))
    (for-each
      (lambda (x)
        (cond
          ((hash-table-exists? d x)
           (hash-table-set! d x (+ 1 (hash-table-ref d x))))
          (else (hash-table-set! d x 1)))) x)
    (hash-table-values d)))

(define has-double?
  (lambda (x)
    (cond
      ((null? x) #f)
      ((= (car x) 2) #t)
      (else (has-double? (cdr x))))))

(define valid-passwords-length2
  (lambda (a b)
    (cond
      ((> a b) 0)
      ((and
         (inc-or-same? (reverse (number->digits a)))
         (has-double? (get-repeat-count (reverse (number->digits a)))))
       (+ 1 (valid-passwords-length2 (+ 1 a) b)))
      (else (valid-passwords-length2 (+ 1 a) b)))))

(valid-passwords-length2 256310 732736) ; 635
