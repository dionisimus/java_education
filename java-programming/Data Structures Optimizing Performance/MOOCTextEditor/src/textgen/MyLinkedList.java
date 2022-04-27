package textgen;

import java.util.AbstractList;


/** A class that implements a doubly linked list
 * 
 * @author UC San Diego Intermediate Programming MOOC team
 *
 * @param <E> The type of the elements stored in the list
 */
public class MyLinkedList<E> extends AbstractList<E> {
	LLNode<E> head;
	LLNode<E> tail;
	int size;
	E data;

	/** Create a new empty LinkedList */
	public MyLinkedList() {
		// TODO: Implement this method
		size = 0;
		head = new LLNode<E>(null);
		tail = new LLNode<E>(null);
		head.next = tail;
		tail.prev = head;
	}

	/**
	 * Appends an element to the end of the list
	 * @param element The element to add
	 */
	public boolean add(E element) 
	{
		// TODO: Implement this method
		if (element == null) {
			throw new NullPointerException("value can't be null");
		}
		LLNode <E> newNode = new LLNode<E>(element);
		newNode.next = tail;
		tail.prev.next = newNode;
		newNode.prev = tail.prev;
		tail.prev = newNode;
	
		size++;

		
		
		return false;
	}

	/** Get the element at position index 
	 * @throws IndexOutOfBoundsException if the index is out of bounds. */
	public E get(int index)
	{
		// TODO: Implement this method.
		LLNode<E> current = new LLNode<E>(null);
		current = head;
		if (index < 0 || index >= size) {
			throw new IndexOutOfBoundsException("invalid index: " + index);
	    }

		else
			for (int i = 0; i <= index; i++) {
				current=current.next;
			}
		
		return current.data;
	}

	/**
	 * Add an element to the list at the specified index
	 * @param The index where the element should be added
	 * @param element The element to add
	 */
	public void add(int index, E element) 
	{
		LLNode<E> current = new LLNode<E>(null);
		LLNode<E> newNode = new LLNode<E>(element);
		current = head;
		// TODO: Implement this method
//		if (element == null) {
//			throw new NullPointerException("value can't be null");
//		}
		if (index < 0 || index > size) {
			throw new IndexOutOfBoundsException("invalid index: " + index);
	    }
		if (element == null) {
			throw new IndexOutOfBoundsException("Cannot be null: " + index);
	    }
		
		if (index == size + 1) {
			this.add(element);
			size++;
		}
		else {
			for (int i = 0; i <= index; i++) {
				current=current.next;
				
			}
			newNode.next = current;
			current.prev.next = newNode;
			newNode.prev = current.prev;
			current.prev = newNode;
			size++;
		}

		
	}


	/** Return the size of the list */
	public int size() 
	{
		// TODO: Implement this method
		return size;
	}

	/** Remove a node at the specified index and return its data element.
	 * @param index The index of the element to remove
	 * @return The data element removed
	 * @throws IndexOutOfBoundsException If index is outside the bounds of the list
	 * 
	 */
	public E remove(int index) 
	{
		// TODO: Implement this method
		LLNode<E> current = new LLNode<E>(null);
		current = head;
		if (index < 0 || index >= size) {
			throw new IndexOutOfBoundsException("invalid index: " + index);
	    }

		else
			for (int i = 0; i <= index; i++) {
				current=current.next;
			}
		current.next.prev = current.prev;
		current.prev.next = current.next;
		current.next = null;
		current.prev = null;
		size--;
				
		
		return current.data;
	}

	/**
	 * Set an index position in the list to a new element
	 * @param index The index of the element to change
	 * @param element The new element
	 * @return The element that was replaced
	 * @throws IndexOutOfBoundsException if the index is out of bounds.
	 */
	public E set(int index, E element) 
	{
		// TODO: Implement this method
		LLNode<E> current = new LLNode<E>(null);
		
		current = head;
		if (index < 0 || index >= size) {
			throw new IndexOutOfBoundsException("invalid index: " + index);
	    }
		if (element == null ) {
			throw new IndexOutOfBoundsException("Cannot be null");
	    }
		else
			for (int i = 0; i <= index; i++) {
				current=current.next;
			}
		current.data = element;
		
		return current.data;
	}   
}

class LLNode<E> 
{
	LLNode<E> prev;
	LLNode<E> next;
	E data;

	// TODO: Add any other methods you think are useful here
	// E.g. you might want to add another constructor

	public LLNode(E e) 
	{
		this.data = e;
		this.prev = null;
		this.next = null;
	}
	


}
