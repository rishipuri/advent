use std::collections::BinaryHeap;
use std::fs::File;
use std::io::BufReader;
use std::io::prelude::*;

fn main() -> std::io::Result<()> {
    let file = File::open("input.txt")?;
    let reader = BufReader::new(file);

    let mut current_count = 0;
    let mut heap = BinaryHeap::new();

    for line in reader.lines() {
        match line.unwrap().parse::<i32>() {
            Ok(n) => {
                current_count += n;
            },
            Err(_) => {
                heap.push(current_count);

                current_count = 0;
            },
        }
    }

    println!("Part 1: {}", heap.peek().unwrap());

    let mut top_3_total = 0;

    for _n in 1..4 {
        match heap.pop() {
            Some(x) => {
                top_3_total += x;
            },
            _ => (),
        }
    }

    println!("Part 2: {}", top_3_total);

    Ok(())
}
