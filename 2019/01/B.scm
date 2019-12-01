(import (chicken io))

(define file->list
  (lambda (filename)
    (call-with-input-file filename
      (lambda (port)
        (read-list port)))))

(define calc-fuel
  (lambda (mass)
    (- (floor (/ mass 3)) 2)))

(define sum-fuel
  (lambda (mass)
    (cond
      ((null? mass) 0)
      ((< (calc-fuel (car mass)) 0) (sum-fuel (cdr mass)))
      (else (+ (calc-fuel (car mass))
               (sum-fuel (cons (calc-fuel (car mass)) (cdr mass))))))))

(sum-fuel (file->list "input.txt")) ; 5089160
