package textgen;

import java.util.AbstractList;

/**
 * A class that implements a doubly linked list
 *
 * @param <E> The type of the elements stored in the list
 * @author UC San Diego Intermediate Programming MOOC team
 */
public class MyLinkedList<E> extends AbstractList<E> {
    LLNode<E> head;
    LLNode<E> tail;
    int size;

    /**
     * Create a new empty LinkedList
     */
    public MyLinkedList() {
        head = null;
        tail = null;
        size = 0;
    }

    /**
     * Appends an element to the end of the list
     *
     * @param element The element to add
     */
    public boolean add(E element) {
        if (element == null) {
            throw new NullPointerException();
        }
        LLNode node = new LLNode<>(element);
        if (size == 0) {
            head = node;
            tail = node;
        } else {
            tail.next = node;
            node.prev = tail;
            tail = node;
        }
        size++;
        return true;
    }

    /**
     * Get the element at position index
     *
     * @throws IndexOutOfBoundsException if the index is out of bounds.
     */
    public E get(int index) {
        return getNodeAtIndex(index).data;
    }

    private LLNode<E> getNodeAtIndex(int index) {
        if (index >= size || index < 0) {
            throw new IndexOutOfBoundsException();
        }
        LLNode<E> node = head;
        for (int i = 0; i < index; i++) {
            node = node.next;
        }
        return node;
    }

    /**
     * Add an element to the list at the specified index
     *
     * @param index where the element should be added
     * @param element The element to add
     */
    public void add(int index, E element) {
        if (index < 0 || index > size) {
            throw new IndexOutOfBoundsException();
        }
        if (element == null) {
            throw new NullPointerException();
        }
        if (size > 0 && index < size) {
            LLNode<E> node = getNodeAtIndex(index);
            LLNode<E> newNode = new LLNode<>(node.prev, node, element);
            if (node.prev != null) {
                node.prev.next = newNode;
            } else {
                head = node;
            }
            node.prev = newNode;
            size++;
        } else {
            add(element);
        }
    }

    /**
     * Return the size of the list
     */
    public int size() {
        return size;
    }

    /**
     * Remove a node at the specified index and return its data element.
     *
     * @param index The index of the element to remove
     * @return The data element removed
     * @throws IndexOutOfBoundsException If index is outside the bounds of the list
     */
    public E remove(int index) {
        LLNode<E> node = getNodeAtIndex(index);
        if (node.prev != null) {
            node.prev.next = node.next;
        } else {
            head = node.next;
        }
        if (node.next != null) {
            node.next.prev = node.prev;
        } else {
            tail = node.prev;
        }
        size--;
        return node.data;
    }

    /**
     * Set an index position in the list to a new element
     *
     * @param index   The index of the element to change
     * @param element The new element
     * @return The element that was replaced
     * @throws IndexOutOfBoundsException if the index is out of bounds.
     */
    public E set(int index, E element) {
        if (element == null) {
            throw new NullPointerException();
        }
        LLNode<E> node = getNodeAtIndex(index);
        LLNode<E> newNode = new LLNode(node.prev, node.next, element);
        if (node.prev != null) {
            node.prev.next = newNode;
        } else {
            head = newNode;
        }
        if (node.next != null) {
            node.next.prev = newNode;
        } else {
            tail = newNode;
        }
        return node.data;
    }
}

class LLNode<E> {
    LLNode<E> prev;
    LLNode<E> next;
    E data;

    public LLNode(LLNode<E> prev, LLNode<E> next, E data) {
        this.prev = prev;
        this.next = next;
        this.data = data;
    }

    public LLNode(E e) {
        this.data = e;
        this.prev = null;
        this.next = null;
    }

}
