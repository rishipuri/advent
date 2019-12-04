(define number->digits
  (lambda (x)
    (cond
      ((zero? x) '())
      (else (cons (remainder x 10) (number->digits (quotient x 10)))))))

(define inc-or-same?
  (lambda (x)
    (cond
      ((or (null? x) (null? (cdr x))) #t)
      ((<= (car x) (car (cdr x))) (inc-or-same? (cdr x)))
      (else #f))))

(define adjacent-same?
  (lambda (x)
    (cond
      ((or (null? x) (null? (cdr x))) #f)
      ((= (car x) (car (cdr x))) #t)
      (else (adjacent-same? (cdr x))))))

(define valid-passwords-length
  (lambda (a b)
    (cond
      ((> a b) 0)
      ((and
         (inc-or-same? (reverse (number->digits a)))
         (adjacent-same? (reverse (number->digits a))))
       (+ 1 (valid-passwords-length (+ 1 a) b)))
      (else (valid-passwords-length (+ 1 a) b)))))

(valid-passwords-length 256310 732736) ; 979
